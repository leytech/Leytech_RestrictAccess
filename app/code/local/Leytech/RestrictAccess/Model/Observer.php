<?php
class Leytech_RestrictAccess_Model_Observer
{
   public function checkAccess()
   {
      // Do nothing if module is not active
      if (!$this->_moduleActive()) {
          return false;
      }

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
         header('HTTP/1.0 403 Forbidden');
         echo 'Access denied.';
         die();
      }
   }

   /**
     * Return the config value for the passed path and key
     */
    private function _getConfig($path, $key)
    {
        $fullpath = 'restrictaccess/' . $path . '/' . $key;
        return Mage::getStoreConfig($fullpath, Mage::app()->getStore());
    }

    /**
     * Return whether the extension has been enabled in the system configuration
     */
    private function _moduleActive()
    {
        return (bool)$this->_getConfig('settings', 'enable_ext');
    }

}