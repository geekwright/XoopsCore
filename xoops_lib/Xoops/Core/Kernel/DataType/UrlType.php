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

/**
 * UrlType
 *
 * @category  Xoops\Core\Kernel\DataType\UrlType
 * @package   Xoops\Core\Kernel
 * @author    trabis <lusopoemas@gmail.com>
 * @copyright 2011-2019 XOOPS Project (https://xoops.org)
 * @license   GNU GPL 2 or later (https://www.gnu.org/licenses/gpl-2.0.html)
 */
class UrlType extends AbstractType
{
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
        $value = trim($obj->vars[$key]['value']);
        if ($obj->vars[$key]['required'] && $value == '') {
            $obj->setErrors(sprintf(\XoopsLocale::F_IS_REQUIRED, $key));
            return $value;
        }
        if ($value != '' && !preg_match("/^http[s]*:\/\//i", $value)) {
            $value = 'http://' . $value;
        }
        return $value;
    }
}
