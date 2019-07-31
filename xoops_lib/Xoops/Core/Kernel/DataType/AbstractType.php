<?php
/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */

namespace Xoops\Core\Kernel\DataType;

use Doctrine\Dbal\ParameterType;
use Doctrine\DBAL\Types;
use Xoops\Core\Kernel\Format;
use Xoops\Core\Kernel\XoopsObject;
use Xoops\Core\Text\Sanitizer;

/**
 * AbstractType
 *
 * @category  Xoops\Core\Kernel\DataType\AbstractType
 * @package   Xoops\Core\Kernel
 * @author    trabis <lusopoemas@gmail.com>
 * @copyright 2011-2019 XOOPS Project (https://xoops.org)
 * @license   GNU GPL 2 or later (https://www.gnu.org/licenses/gpl-2.0.html)
 */
abstract class AbstractType
{
    /**
     * @var Sanitizer
     */
    protected $ts;

    /**
     * Sets database and sanitizer for easy access
     */
    public function __construct()
    {
        $this->ts = Sanitizer::getInstance();
    }

    /**
     * cleanVar prepare variable for persistence
     *
     * @param XoopsObject $obj object containing variable
     * @param string      $key name of variable
     *
     * @return mixed
     */
    public function cleanVar(XoopsObject $obj, $key)
    {
        $value = $obj->vars[$key]['value'];
        return $value;
    }

    /**
     * getVar get variable prepared according to format
     *
     * @param XoopsObject $obj    object containing variable
     * @param string      $key    name of variable
     * @param string      $format Format::* constant indicating desired formatting
     *
     * @return mixed
    */
    public function getVar(XoopsObject $obj, $key, $format)
    {
        $value = $obj->vars[$key]['value'];
        if ($obj->vars[$key]['options'] != '' && $value != '') {
            $format .= ' ';
            switch (strtolower($format[0])) {
                case Format::SHOW:
                    $selected = explode('|', $value);
                    $options = explode('|', $obj->vars[$key]['options']);
                    $i = 1;
                    $ret = array();
                    foreach ($options as $op) {
                        if (in_array($i, $selected)) {
                            $ret[] = $op;
                        }
                        ++$i;
                    }
                    return implode(', ', $ret);
                case Format::EDIT:
                    return explode('|', $value);
                default:
            }
        }
        return $value;
    }

    /**
     * Return the appropriate Doctrine\Dbal\ParameterType constant appropriate for this DataType's
     * database storage. This is used to bind parameters correctly in prepared statements
     *
     * Valid values are:
     *   ParameterType::NULL
     *   ParameterType::INTEGER
     *   ParameterType::STRING
     *   ParameterType::LARGE_OBJECT
     *   ParameterType::BOOLEAN
     *   ParameterType::BINARY
     *
     * @return int ParameterType constant
     */
    public function getBindingType()
    {
        return ParameterType::STRING;
    }
}
