<?php
/**
 * XOOPS Kernel Class
 *
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @copyright       XOOPS Project (http://xoops.org)
 * @license         GNU GPL 2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 * @package         kernel
 * @since           2.0.0
 * @author          Kazumi Ono (AKA onokazu) http://www.myweb.ne.jp/, http://jp.xoops.org/
 * @version         $Id$
 */

namespace Xoops\Core\Kernel\Handlers;

use Xoops\Core\Kernel\DataType;
use Xoops\Core\Kernel\Format;
use Xoops\Core\Kernel\XoopsObject;

/**
 * a group of users
 *
 * @category  Xoops\Core\Kernel\Handlers\XoopsGroup
 * @package   Xoops\Core\Kernel
 * @author    Kazumi Ono <onokazu@xoops.org>
 * @copyright 2000-2019 XOOPS Project (https://xoops.org)
 * @license   GNU GPL 2 or later (https://www.gnu.org/licenses/gpl-2.0.html)
 */
class XoopsGroup extends XoopsObject
{
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->initVar('groupid', DataType::INTEGER, null, false);
        $this->initVar('name', DataType::STRING, null, true, 100);
        $this->initVar('description', DataType::TEXT, null, false);
        $this->initVar('group_type', DataType::OTHER, null, false);
    }

    /**
     * getter
     *
     * @param string $format Format::xxxx constant
     *
     * @return mixed
     */
    public function id($format = Format::NONE)
    {
        return $this->getVar('groupid', $format);
    }

    /**
     * getter
     *
     * @param string $format Format::xxxx constant
     *
     * @return mixed
     */
    public function groupid($format = '')
    {
        return $this->getVar('groupid', $format);
    }

    /**
     * getter
     *
     * @param string $format Format::xxxx constant
     *
     * @return mixed
     */
    public function name($format = '')
    {
        return $this->getVar('name', $format);
    }

    /**
     * getter
     *
     * @param string $format Format::xxxx constant
     *
     * @return mixed
     */
    public function description($format = '')
    {
        return $this->getVar('description', $format);
    }

    /**
     * getter
     *
     * @param string $format Format::xxxx constant
     *
     * @return mixed
     */
    public function group_type($format = '')
    {
        return $this->getVar('group_type', $format);
    }
}
