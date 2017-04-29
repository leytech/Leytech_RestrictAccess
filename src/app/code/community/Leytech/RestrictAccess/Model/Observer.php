<?php
/**
 * @package    Leytech_RestrictAccess
 * @author     Chris Nolan (chris@leytech.co.uk)
 * @copyright  Copyright (c) 2017 Leytech
 * @license    https://opensource.org/licenses/MIT  The MIT License  (MIT)
 */

class Leytech_RestrictAccess_Model_Observer
{
    public function checkAccess()
    {
        $helper = Mage::helper('leytech_restrictaccess');

        // Do nothing if module is not active
        if (!$helper->isEnabled()) {
            return $this;
        }

        // Do nothing if current IP address is allowed
        if ($helper->isIpAllowed()) {
            return $this;
        }

        // Check admin session
        if (Mage::helper('core')->isModuleEnabled('Pulsestorm_Crossareasession') && $helper->getAdminAccessPermitted()) {
            // Load the cross area session model
            $manager = Mage::getModel('pulsestorm_crossareasession/manager');
            // Check whether the user has access to admin/leytech_allow_front
            if($manager->checkAdminAclRule('admin/leytech_allow_front')) {
                return $this;
            }
        }

        $helper->logDeniedAccess();
        header('HTTP/1.0 403 Forbidden');
        echo $helper->getMessage();
        die();

    }

}