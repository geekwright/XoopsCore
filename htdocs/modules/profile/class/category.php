<?php
/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

use Xoops\Core\Database\Connection;
use Xoops\Core\Kernel\DataType;
use Xoops\Core\Kernel\XoopsObject;
use Xoops\Core\Kernel\XoopsPersistableObjectHandler;

/**
 * Extended User Profile
 *
 * @copyright       2000-2019 XOOPS Project (https://xoops.org)
 * @license         GNU GPL 2 or later (httpss://www.gnu.org/licenses/gpl-2.0.html)
 * @package         profile
 * @since           2.3.0
 * @author          Jan Pedersen
 * @author          Taiwen Jiang <phppp@users.sourceforge.net>
 */

class ProfileCategory extends XoopsObject
{
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->initVar('cat_id', DataType::INTEGER, null, true);
        $this->initVar('cat_title', DataType::STRING);
        $this->initVar('cat_description', DataType::TEXT);
        $this->initVar('cat_weight', DataType::INTEGER);
    }
}

class ProfileCategoryHandler extends XoopsPersistableObjectHandler
{
    /**
     * @param null|Connection $db database
     */
    public function __construct(Connection $db = null)
    {
        parent::__construct($db, 'profile_category', 'profilecategory', 'cat_id', 'cat_title');
    }
}
