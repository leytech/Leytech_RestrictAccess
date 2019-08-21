<?php
class Leytech_RestrictAccess_Model_Adminhtml_System_Config_Source_Allowedips_Comment extends Mage_Core_Model_Config_Data
{
    public function getCommentText()
    {
        return sprintf(
            'List of IP addresses (one per line) that will not be restricted. Your current IP is %s',
            Mage::helper('core/http')->getRemoteAddr()
        );
    }
}