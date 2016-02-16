<?php
class Leytech_RestrictAccess_Model_Observer
{
   public function checkAccess()
   {
      $adminurl = (string)Mage::getConfig()->getNode('admin/routers/adminhtml/args/frontName');

      $urlstring = Mage::helper('core/url')->getCurrentUrl();
      $url = Mage::getSingleton('core/url')->parseUrl($urlstring);

      if (strstr($url->path, "/{$adminurl}"))   return $this; // this is the admin section

      // get admin session
      Mage::getSingleton('core/session', array('name' => 'adminhtml'))->start();

      $admin_logged_in = Mage::getSingleton('admin/session', array('name' => 'adminhtml'))->isLoggedIn();

      // return to frontend section
      Mage::getSingleton('core/session', array('name' => 'frontend'))->start();

      if (!$admin_logged_in)
      {
         die('No access!');
      }
   }
}