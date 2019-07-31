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

/**
 * Format - define format codes used in getVar() methods
 *
 * @category  Xoops\Core\Kernel\Format
 * @package   Xoops\Core\Kernel
 * @author    Richard Griffith <richard@geekwright.com>
 * @copyright 2011-2019 XOOPS Project (https://xoops.org)
 * @license   GNU GPL 2 or later (https://www.gnu.org/licenses/gpl-2.0.html)
 */
class Format
{
    /**
     * format constants used for getVar()
     */
    public const SHOW = 's';
    public const EDIT = 'e';
    public const PREVIEW = 'p';
    public const FORM_PREVIEW = 'f';
    public const NONE = 'n';
}
