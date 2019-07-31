<?php
/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

/**
 * banners module
 *
 * @copyright       XOOPS Project (https://xoops.org)
 * @license         GNU GPL 2 or later (https://www.gnu.org/licenses/gpl-2.0.html)
 * @package         banners
 * @since           2.6.0
 * @author          Mage Gregory (AKA Mage)
 */

use Xoops\Core\Database\Connection;
use Xoops\Core\Kernel\DataType;
use Xoops\Core\Kernel\XoopsObject;
use Xoops\Core\Kernel\XoopsPersistableObjectHandler;

class BannersBannerclient extends XoopsObject
{
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->initVar('bannerclient_cid', DataType::INTEGER, null, false, 5);
        $this->initVar('bannerclient_uid', DataType::INTEGER, 0, true);
        $this->initVar('bannerclient_name', DataType::STRING, null, false);
        $this->initVar('bannerclient_extrainfo', DataType::TEXT, null, false);
    }
    public function get_new_id()
    {
        return Xoops::getInstance()->db()->lastInsertId();
    }
}

class BannersBannerclientHandler extends XoopsPersistableObjectHandler
{
    /**
     * @param null|Connection $db database
     */
    public function __construct(Connection $db = null)
    {
        parent::__construct($db, 'banners_bannerclient', 'BannersBannerclient', 'bannerclient_cid', 'bannerclient_name');
    }
}
