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
 * A Config-Option
 *
 * @category  Xoops\Core\Kernel\Handlers\XoopsConfigOption
 * @package   Xoops\Core\Kernel
 * @author    Kazumi Ono <onokazu@xoops.org>
 * @copyright 2000-2019 XOOPS Project (https://xoops.org)
 * @license   GNU GPL 2 or later (https://www.gnu.org/licenses/gpl-2.0.html)
 */
class XoopsConfigOption extends XoopsObject
{
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->initVar('confop_id', DataType::INTEGER, null);
        $this->initVar('confop_name', DataType::STRING, null, true, 255);
        $this->initVar('confop_value', DataType::STRING, null, true, 255);
        $this->initVar('conf_id', DataType::INTEGER, 0);
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
        return $this->getVar('confop_id', $format);
    }

    /**
     * getter
     *
     * @param string $format Format::xxxx constant
     *
     * @return mixed
     */
    public function confop_id($format = '')
    {
        return $this->getVar('confop_id', $format);
    }

    /**
     * getter
     *
     * @param string $format Format::xxxx constant
     *
     * @return mixed
     */
    public function confop_name($format = '')
    {
        return $this->getVar('confop_name', $format);
    }

    /**
     * getter
     *
     * @param string $format Format::xxxx constant
     *
     * @return mixed
     */
    public function confop_value($format = '')
    {
        return $this->getVar('confop_value', $format);
    }

    /**
     * getter
     *
     * @param string $format Format::xxxx constant
     *
     * @return mixed
     */
    public function conf_id($format = '')
    {
        return $this->getVar('conf_id', $format);
    }
}
