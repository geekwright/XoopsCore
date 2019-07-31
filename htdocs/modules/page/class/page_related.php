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
 * page module
 *
 * @copyright       XOOPS Project (https://xoops.org)
 * @license         GNU GPL 2 or later (https://www.gnu.org/licenses/gpl-2.0.html)
 * @package         page
 * @author          Mage Grégory (AKA Mage)
 */

class PagePage_related extends XoopsObject
{
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->initVar('related_id', DataType::INTEGER, 0, false, 8);
        $this->initVar('related_name', DataType::STRING, '', false);
        $this->initVar('related_domenu', DataType::INTEGER, 1, false, 1);
        $this->initVar('related_navigation', DataType::INTEGER, 1, false, 1);
    }

    public function getValues($keys = null, $format = null, $maxDepth = null)
    {
        $ret = parent::getValues($keys, $format, $maxDepth);
        $ret['navigation'] = \Xoops\Locale::translate('L_RELATED_NAVIGATION_OPTION' . $this->getVar('related_navigation'), 'page');
        $ret['related_links'] = Page::getInstance()->getLinkHandler()->getLinks($this->getVar('related_id'));
        return $ret;
    }

    public function get_new_id()
    {
        $xoops = Xoops::getInstance();
        $new_id = $xoopsDB->getInsertId();
        return $new_id;
    }
}

class PagePage_relatedHandler extends XoopsPersistableObjectHandler
{
    /**
     * @param null|Connection $db
     */
    public function __construct(Connection $db = null)
    {
        parent::__construct($db, 'page_related', 'pagepage_related', 'related_id', 'related_name');
    }

    public function getRelated($start = 0, $limit = 0, $sort = 'related_name', $order = 'ASC')
    {
        $criteria = new CriteriaCompo();
        $criteria->setSort($sort);
        $criteria->setOrder($order);
        $criteria->setStart($start);
        $criteria->setLimit($limit);
        return parent::getAll($criteria, null, false);
    }

    public function countRelated($start = 0, $limit = 0, $sort = 'related_name', $order = 'ASC')
    {
        $criteria = new CriteriaCompo();
        $criteria->setSort($sort);
        $criteria->setOrder($order);
        $criteria->setStart($start);
        $criteria->setLimit($limit);
        return parent::getCount();
    }
}
