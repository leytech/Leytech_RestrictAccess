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

        $helper->logDeniedAccess();
        header('HTTP/1.0 403 Forbidden');
        echo $helper->getMessage();
        die();

        /*
        // get admin session
        Mage::getSingleton('core/session', array('name' => 'adminhtml'))->start();

        $admin_logged_in = Mage::getSingleton('admin/session', array('name' => 'adminhtml'))->isLoggedIn();

        // return to frontend session
        Mage::getSingleton('core/session', array('name' => 'frontend'))->start();

        if (!$admin_logged_in)
        {
            $helper->logDeniedAccess();
            header('HTTP/1.0 403 Forbidden');
            echo $helper->getMessage();
            die();
        }
        */
    }

}