<?php
/**
 * @package    Leytech_RestrictAccess
 * @author     Chris Nolan (chris@leytech.co.uk)
 * @copyright  Copyright (c) 2017 Leytech
 * @license    https://opensource.org/licenses/MIT  The MIT License  (MIT)
 */

class Leytech_RestrictAccess_Block_Adminhtml_Notification extends Mage_Adminhtml_Block_Template
{
    /**
     * Check if restrict access notice should be displayed
     *
     * @return boolean
     */
    public function displayRestrictAccessNotice()
    {
        return (bool) Mage::getStoreConfig(Leytech_RestrictAccess_Helper_Data::XML_PATH_IS_ENABLED);
    }

    /**
     * Get management url
     *
     * @return bool
     */
    public function getManageUrl()
    {
        return $this->getUrl('adminhtml/system_config/edit/section/leytech_restrictaccess');
    }

    /**
     * ACL validation for adding the link to the notification message
     *
     * @return bool
     */
    protected function canConfigure()
    {
        if (Mage::getSingleton('admin/session')->isAllowed('system/config/leytech_restrictaccess')) {
            return true;
        }
        return false;
    }

}
