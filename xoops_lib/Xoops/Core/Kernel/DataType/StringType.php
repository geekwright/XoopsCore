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

use Xoops\Core\Kernel\Format;
use Xoops\Core\Kernel\XoopsObject;

/**
 * StringType
 *
 * @category  Xoops\Core\Kernel\DataType\StringType
 * @package   Xoops\Core\Kernel
 * @author    trabis <lusopoemas@gmail.com>
 * @copyright 2011-2019 XOOPS Project (https://xoops.org)
 * @license   GNU GPL 2 or later (https://www.gnu.org/licenses/gpl-2.0.html)
 */
class StringType extends AbstractType
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
            case Format::SHOW:
            case Format::EDIT:
                return $this->ts->htmlSpecialChars($value);
            case Format::PREVIEW:
            case Format::FORM_PREVIEW:
                return $this->ts->htmlSpecialChars($value);
            case Format::NONE:
            default:
                return $value;
        }
    }

    /**
     * cleanVar prepare variable for persistence
     *
     * @param XoopsObject $obj object containing variable
     * @param string      $key name of variable
     *
     * @return string
     */
    public function cleanVar(XoopsObject $obj, $key)
    {
        $value = $obj->vars[$key]['value'];
        if ($obj->vars[$key]['required'] && $value != '0' && $value == '') {
            $obj->setErrors(sprintf(\XoopsLocale::F_IS_REQUIRED, $key));
            return $value;
        }
        if (isset($obj->vars[$key]['maxlength']) && mb_strlen($value) > (int)($obj->vars[$key]['maxlength'])) {
            $obj->setErrors(sprintf(\XoopsLocale::F_MUST_BE_SHORTER_THAN, $key, (int)($obj->vars[$key]['maxlength'])));
            return $value;
        }

        $value = $this->ts->censorString($value);

        return $value;
    }
}
