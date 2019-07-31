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
 * @license         GNU GPL 2 or later (https://www.gnu.org/licenses/gpl-2.0.html)
 * @package         profile
 * @since           2.3.0
 * @author          Jan Pedersen
 * @author          Taiwen Jiang <phppp@users.sourceforge.net>
 */

class ProfileRegstep extends XoopsObject
{
    public function __construct()
    {
        $this->initVar('step_id', DataType::INTEGER);
        $this->initVar('step_name', DataType::STRING);
        $this->initVar('step_desc', DataType::TEXT);
        $this->initVar('step_order', DataType::INTEGER, 1);
        $this->initVar('step_save', DataType::INTEGER, 0);
    }
}

class ProfileRegstepHandler extends XoopsPersistableObjectHandler
{
    /**
     * @param null|Connection $db
     */
    public function __construct(Connection $db = null)
    {
        parent::__construct($db, 'profile_regstep', 'profileregstep', 'step_id', 'step_name');
    }

    /**
     * Delete an object from the database
     * @see XoopsPersistableObjectHandler
     *
     * @param XoopsObject|ProfileRegstep $obj
     * @param bool $force
     *
     * @return bool
     */
    public function deleteRegstep(XoopsObject $obj, $force = false)
    {
        if (parent::delete($obj, $force)) {
            $field_handler = \Xoops::getModuleHelper('profile')->getHandler('field');
            return $field_handler->updateAll('step_id', 0, new Criteria('step_id', $obj->getVar('step_id')), $force);
        }
        return false;
    }
}
