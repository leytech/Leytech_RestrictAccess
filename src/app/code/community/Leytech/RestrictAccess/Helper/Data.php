<?php
/**
 * @package    Leytech_RestrictAccess
 * @author     Chris Nolan (chris@leytech.co.uk)
 * @copyright  Copyright (c) 2017 Leytech
 * @license    https://opensource.org/licenses/MIT  The MIT License  (MIT)
 */

class Leytech_RestrictAccess_Helper_Data extends Mage_Core_Helper_Abstract
{
    const XML_PATH_IS_ENABLED = 'leytech_restrictaccess/settings/enabled';
    const XML_PATH_ALLOWED_IPS = 'leytech_restrictaccess/settings/allowed_ips';
    const XML_PATH_ALLOW_EMPTY_IP = 'leytech_restrictaccess/settings/allow_empty_ip';
    const XML_PATH_USE_503_ERROR = 'leytech_restrictaccess/settings/use_503_error';
    const XML_PATH_MESSAGE = 'leytech_restrictaccess/settings/message';
    const XML_PATH_ENABLE_LOG = 'leytech_restrictaccess/settings/enable_log';
    const XML_PATH_LOG_FILE = 'leytech_restrictaccess/settings/log_file';

    const XML_PATH_ADMIN_ACCESS_PERMITTED = 'leytech_restrictaccess/admin_access/permitted';

    public function isEnabled() {
        return Mage::getStoreConfig(self::XML_PATH_IS_ENABLED);
    }

    public function getAllowedIps() {
        return Mage::getStoreConfig(self::XML_PATH_ALLOWED_IPS);
    }

    public function getAllowEmptyIp() {
        return Mage::getStoreConfig(self::XML_PATH_ALLOW_EMPTY_IP);
    }

    public function getUse503Error() {
        return Mage::getStoreConfig(self::XML_PATH_USE_503_ERROR);
    }

    public function getMessage() {
        return Mage::getStoreConfig(self::XML_PATH_MESSAGE);
    }

    public function getEnableLog() {
        return Mage::getStoreConfig(self::XML_PATH_ENABLE_LOG);
    }

    public function getLogFile() {
        return Mage::getStoreConfig(self::XML_PATH_LOG_FILE);
    }

    public function getAdminAccessPermitted() {
        return Mage::getStoreConfig(self::XML_PATH_ADMIN_ACCESS_PERMITTED);
    }

    /**
     * Return whether the current IP address is allowed access
     */
    public function isIpAllowed()
    {
        // Get the remote IP address
        $ip = Mage::helper('core/http')->getRemoteAddr();

        // Allow empty IPs if configured otherwise reject them
        if (!$ip) {
            if($this->getAllowEmptyIp()) {
                return true;
            } else {
                return false;
            }
        }

        // Allow if IP is in list of allowed IPs
        $allowed = preg_split("/\r\n|\n|\r/", $this->getAllowedIps());
        if (in_array($ip, $allowed)) {
            return true;
        }

        return false;
    }

    /**
     * Log any denied access requests
     */
    public function logDeniedAccess() {
        // Only log if logging is enabled
        if(!$this->getEnableLog()) {
            return;
        }
        // Log the access attempt
        Mage::log(
            sprintf(
                'Leytech_RestrictAccess: Access denied to %s from address %s',
                    Mage::helper('core/url')->getCurrentUrl(),
                    $_SERVER["REMOTE_ADDR"]
            ),
            null,
            $this->getLogFile()
        );
    }



}