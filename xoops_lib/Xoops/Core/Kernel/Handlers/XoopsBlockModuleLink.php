<?php
/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

namespace Xoops\Core\Kernel\Handlers;

use Xoops\Core\Kernel\DataType;
use Xoops\Core\Kernel\XoopsObject;

/**
 * XOOPS Kernel Class
 *
 * @category  Xoops\Core\Kernel\Handlers\XoopsBlockModuleLink
 * @package   Xoops\Core\Kernel
 * @author    Gregory Mage (AKA Mage)
 * @author    trabis <lusopoemas@gmail.com>
 * @copyright 2000-2019 XOOPS Project (https://xoops.org)
 * @license   GNU GPL 2 or later (https://www.gnu.org/licenses/gpl-2.0.html)
 */
class XoopsBlockModuleLink extends XoopsObject
{
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->initVar('block_id', DataType::INTEGER);
        $this->initVar('module_id', DataType::INTEGER);
    }
}
