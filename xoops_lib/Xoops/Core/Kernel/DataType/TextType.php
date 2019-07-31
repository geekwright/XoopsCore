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
 * TextType
 *
 * @category  Xoops\Core\Kernel\DataType\TextType
 * @package   Xoops\Core\Kernel
 * @author    trabis <lusopoemas@gmail.com>
 * @copyright 2011-2019 XOOPS Project (https://xoops.org)
 * @license   GNU GPL 2 or later (https://www.gnu.org/licenses/gpl-2.0.html)
 */
class TextType extends AbstractType
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
                $html = !empty($obj->vars['dohtml']['value']) ? 1 : 0;
                $xcode = (!isset($obj->vars['doxcode']['value']) || $obj->vars['doxcode']['value'] == 1) ? 1 : 0;
                $smiley = (!isset($obj->vars['dosmiley']['value']) || $obj->vars['dosmiley']['value'] == 1) ? 1 : 0;
                $image = (!isset($obj->vars['doimage']['value']) || $obj->vars['doimage']['value'] == 1) ? 1 : 0;
                $br = (!isset($obj->vars['dobr']['value']) || $obj->vars['dobr']['value'] == 1) ? 1 : 0;
                return $this->ts->displayTarea($value, $html, $smiley, $xcode, $image, $br);
            case Format::EDIT:
                return htmlspecialchars($value, ENT_QUOTES);
            case Format::PREVIEW:
                $html = !empty($obj->vars['dohtml']['value']) ? 1 : 0;
                $xcode = (!isset($obj->vars['doxcode']['value']) || $obj->vars['doxcode']['value'] == 1) ? 1 : 0;
                $smiley = (!isset($obj->vars['dosmiley']['value']) || $obj->vars['dosmiley']['value'] == 1) ? 1 : 0;
                $image = (!isset($obj->vars['doimage']['value']) || $obj->vars['doimage']['value'] == 1) ? 1 : 0;
                $br = (!isset($obj->vars['dobr']['value']) || $obj->vars['dobr']['value'] == 1) ? 1 : 0;
                return $this->ts->previewTarea($value, $html, $smiley, $xcode, $image, $br);
            case Format::FORM_PREVIEW:
                return htmlspecialchars($value, ENT_QUOTES);
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

        $value = $this->ts->censorString($value);

        return $value;
    }
}
