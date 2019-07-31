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

use \DateTime;
use \DateTimeZone;
use Xoops\Core\Kernel\Format;
use Xoops\Core\Kernel\XoopsObject;

/**
 * TimeZoneType
 *
 * Data is stored as varchar(32) string, returned as \DateTimeZone object
 *
 * @category  Xoops\Core\Kernel\DataType
 * @package   Xoops\Core\Kernel
 * @author    trabis <lusopoemas@gmail.com>
 * @copyright 2011-2019 XOOPS Project (https://xoops.org)
 * @license   GNU GPL 2 or later (https://www.gnu.org/licenses/gpl-2.0.html)
 */
class TimeZoneType extends AbstractType
{
    /**
     * getVar get variable prepared according to format
     *
     * @param XoopsObject $obj    object containing variable
     * @param string      $key    name of variable
     * @param string      $format Format::* constant indicating desired formatting
     *
     * @return int|DateTime
     */
    public function getVar(XoopsObject $obj, $key, $format)
    {
        $storedValue = $obj->vars[$key]['value'];
        $format .= ' ';
        switch (strtolower($format[0])) {
            case Format::NONE:
                $value = $storedValue;
                break;
            default:
                try {
                    $value = new DateTimeZone($storedValue);
                } catch (\Exception $e) {
                    $value = new DateTimeZone('UTC');
                }
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
     * @return int
     */
    public function cleanVar(XoopsObject $obj, $key)
    {
        $value = $obj->vars[$key]['value'];
        if ($value instanceof DateTimeZone) {
            $cleanValue = $value->getName();
        } elseif ($value instanceof DateTime) {
            $cleanValue = $value->getTimezone()->getName();
        } else {
            try {
                $temp = new DateTimeZone($value);
                $cleanValue = $temp->getName();
            } catch (\Exception $e) {
                $cleanValue = 'UTC';
            }
        }

        return $cleanValue;
    }
}
