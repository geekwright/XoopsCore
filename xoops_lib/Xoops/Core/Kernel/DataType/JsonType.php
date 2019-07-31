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

use Xoops\Core\Kernel\XoopsObject;
use Xoops\Core\Kernel\Format;

/**
 * JsonType
 *
 * @category  Xoops\Core\Kernel\DataType\JsonType
 * @package   Xoops\Core\Kernel
 * @author    Richard Griffith <richard@geekwright.com>
 * @copyright 2015-2019 XOOPS Project (https://xoops.org)
 * @license   GNU GPL 2 or later (https://www.gnu.org/licenses/gpl-2.0.html)
 */
class JsonType extends AbstractType
{
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
        $format .= ' ';
        switch (strtolower($format[0])) {
            case Format::NONE:
                break;
            default:
                $decoded = json_decode($value, true);
                $value = (false === $decoded) ? null : $decoded;
                break;
        }
        return $value;
    }

    /**
     * cleanVar prepare variable for persistence
     *
     * @param XoopsObject $obj object containing variable
     * @param string      $key name of variable
     *
     * @return string|null
     */
    public function cleanVar(XoopsObject $obj, $key)
    {
        $value = $obj->vars[$key]['value'];
        $value = ($value===null || $value==='' || $value===false) ? null : $value;
        if ($value!==null && null === json_decode($value, true)) {
            $value = json_encode($value, JSON_FORCE_OBJECT);
            if ($value===false) {
                \Xoops::getInstance()->logger()->warning(
                    sprintf('Failed to encode to JSON - %s', json_last_error_msg())
                );
                $value = null;
            }
        }
        return $value;
    }
}
