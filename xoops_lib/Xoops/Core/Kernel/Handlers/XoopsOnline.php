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
 * Online object
 *
 * @category  Xoops\Core\Kernel\Handlers\XoopsOnline
 * @package   Xoops\Core\Kernel
 * @author    trabis <lusopoemas@gmail.com>
 * @copyright 2000-2019 XOOPS Project (https://xoops.org)
 * @license   GNU GPL 2 or later (https://www.gnu.org/licenses/gpl-2.0.html)
 */
class XoopsOnline extends XoopsObject
{
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->initVar('online_uid', DataType::INTEGER, null, false);
        $this->initVar('online_uname', DataType::STRING, null, true);
        $this->initVar('online_updated', DataType::INTEGER, null, true);
        $this->initVar('online_module', DataType::INTEGER, null, true);
        $this->initVar('online_ip', DataType::STRING, null, true);
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
        return $this->online_uid($format);
    }

    /**
     * getter
     *
     * @param string $format Format::xxxx constant
     *
     * @return mixed
     */
    public function online_uid($format = Format::NONE)
    {
        return $this->getVar('online_uid', $format);
    }

    /**
     * getter
     *
     * @param string $format Format::xxxx constant
     *
     * @return mixed
     */
    public function online_uname($format = '')
    {
        return $this->getVar('online_uname', $format);
    }

    /**
     * getter
     *
     * @param string $format Format::xxxx constant
     *
     * @return mixed
     */
    public function online_updated($format = '')
    {
        return $this->getVar('online_updated', $format);
    }

    /**
     * getter
     *
     * @param string $format Format::xxxx constant
     *
     * @return mixed
     */
    public function online_module($format = '')
    {
        return $this->getVar('online_module', $format);
    }

    /**
     * getter
     *
     * @param string $format Format::xxxx constant
     *
     * @return mixed
     */
    public function online_ip($format = '')
    {
        return $this->getVar('online_ip', $format);
    }
}
