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

class BannersBanner extends XoopsObject
{
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->initVar('banner_bid', DataType::INTEGER, null, false, 5);
        $this->initVar('banner_cid', DataType::INTEGER, null, false, 3);
        $this->initVar('banner_imptotal', DataType::INTEGER, null, false, 8);
        $this->initVar('banner_impmade', DataType::INTEGER, null, false, 8);
        $this->initVar('banner_clicks', DataType::INTEGER, null, false, 8);
        $this->initVar('banner_imageurl', DataType::TEXT, null, false);
        $this->initVar('banner_clickurl', DataType::TEXT, null, false);
        $this->initVar('banner_datestart', DataType::INTEGER, null, false, 10);
        $this->initVar('banner_dateend', DataType::INTEGER, null, false, 10);
        $this->initVar('banner_htmlbanner', DataType::INTEGER, null, false, 1);
        $this->initVar('banner_htmlcode', DataType::TEXT, null, false);
        $this->initVar('banner_status', DataType::INTEGER, null, false, 1);
    }
}

class BannersBannerHandler extends XoopsPersistableObjectHandler
{
    /**
     * @param null|Connection $db database
     */
    public function __construct(Connection $db = null)
    {
        parent::__construct($db, 'banners_banner', 'BannersBanner', 'banner_bid', 'banner_imageurl');
    }
}
