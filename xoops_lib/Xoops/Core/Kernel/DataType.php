<?php
/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */

namespace Xoops\Core\Kernel;

use Xoops\Core\Exception\InvalidDataTypeException;
use Xoops\Core\Kernel\DataType\AbstractType;
use Xoops\Core\Kernel\DataType\OtherType;

/**
 * DataType
 *
 * @category  Xoops\Core\Kernel\DataType
 * @package   Xoops\Core\Kernel
 * @author    trabis <lusopoemas@gmail.com>
 * @copyright 2011-2019 XOOPS Project (https//xoops.org)
 * @license   GNU GPL 2 or later (https://www.gnu.org/licenses/gpl-2.0.html)
 */
class DataType
{
    const ARRAY       = DataType\ArrayType::class;
    const DATETIME    = DataType\DateTimeType::class;
    const DECIMAL     = DataType\DecimalType::class;
    const EMAIL       = DataType\EmailType::class;
    const ENUM        = DataType\EnumerationType::class;
    const FLOAT       = DataType\FloatType::class;
    const INTEGER     = DataType\IntegerType::class;
    const JSON        = DataType\JsonType::class;
    const MONEY       = DataType\MoneyType::class;
    const OTHER       = DataType\OtherType::class;
    const SOURCE      = DataType\SourceType::class;
    const TEXT        = DataType\TextType::class;
    const STRING      = DataType\StringType::class;
    const TIMEZONE    = DataType\TimeZoneType::class;
    const URL         = DataType\UrlType::class;
    const SHORT_TIME  = DataType\SimpleTimeType::class;
    const MEDIUM_TIME = DataType\SimpleTimeType::class;
    const LONG_TIME   = DataType\SimpleTimeType::class;

    /**
     * cleanVar
     *
     * @param XoopsObject $obj object
     * @param mixed       $key key
     *
     * @throws InvalidDataTypeException
     *
     * @return mixed
     */
    public static function cleanVar(XoopsObject $obj, $key)
    {
        return DataType::loadDataType(DataType::getDataTypeName($obj, $key))->cleanVar($obj, $key);
    }

    /**
     * getVar
     *
     * @param XoopsObject $obj    object
     * @param string      $key    key
     * @param string      $format format
     *
     * @throws InvalidDataTypeException
     *
     * @return mixed
     */
    public static function getVar(XoopsObject $obj, $key, $format)
    {
        return DataType::loadDataType(DataType::getDataTypeName($obj, $key))
                ->getVar($obj, $key, $format);
    }

    /**
     * getBindingType
     *
     * Return the appropriate Doctrine\Dbal\ParameterType constant for the specified column
     * This is used to bind parameters correctly in prepared statements
     *
     * @param XoopsObject $obj object
     * @param mixed       $key key
     *
     * @throws InvalidDataTypeException
     *
     * @return mixed
     */
    public static function getBindingType(XoopsObject $obj, $key)
    {
        return DataType::loadDataType(DataType::getDataTypeName($obj, $key))->getBindingType();
    }

    /**
     * loadDataType
     *
     * @param string $className dtype name to load
     *
     * @throws InvalidDataTypeException
     *
     * @return AbstractType
     */
    private static function loadDataType($className): AbstractType
    {
        static $dtypes;

        $dtype = null;
        if (!isset($dtypes[$className])) {
            $dtype = new $className();
            if (!$dtype instanceof AbstractType) {
                throw new InvalidDataTypeException("DataType '{$className}' not found");
            }
            $dtypes[$className] = $dtype;
        }

        return $dtypes[$className];
    }

    /**
     * getDataTypeName
     *
     * @param XoopsObject $obj object
     * @param mixed       $key key
     *
     * @return string
     *
     * @throws InvalidDataTypeException
     */
    private static function getDataTypeName(XoopsObject $obj, $key): string
    {
        $dType = $obj->vars[$key]['data_type'];
        if (!class_exists($dType)) {
            throw new InvalidDataTypeException("DataType '{$dType}' not found");
        }
        return $dType;

        /*
        static $legacyNames = array(
            1 => 'StringType',
            2 => 'TextType',
            3 => 'IntegerType',
            4 => 'UrlType',
            5 => 'EmailType',
            6 => 'ArrayType',
            7 => 'OtherType',
            8 => 'SourceType',
            9 => 'SimpleTimeType',
            10 => 'SimpleTimeType',
            11 => 'SimpleTimeType',
            13 => 'FloatType',
            14 => 'DecimalType',
            15 => 'EnumerationType',
            30 => 'JsonType',
            31 => 'DateTimeType',
            32 => 'TimeZoneType',
            33 => 'MoneyType',
        );

        $nameIndex = $obj->vars[$key]['data_type'];
        if (isset($legacyNames[$nameIndex])) {
            return $legacyNames[$nameIndex];
        }
        return 'OtherType';
        */
    }
}
