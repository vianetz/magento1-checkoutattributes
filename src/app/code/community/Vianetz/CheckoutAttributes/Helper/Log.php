<?php
/**
 * Core Log Helper class
 *
 * @section LICENSE
 * This file is created by vianetz <info@vianetz.com>.
 * The Magento module is distributed under a commercial license.
 * Any redistribution, copy or direct modification is explicitly not allowed.
 *
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@vianetz.com so we can send you a copy immediately.
 *
 * @category    Vianetz
 * @package     Vianetz_Core
 * @author      Christoph Massmann, <C.Massmann@vianetz.com>
 * @link        http://www.vianetz.com
 * @copyright   Copyright (c) 2006-16 vianetz - C. Massmann (http://www.vianetz.com)
 * @license     http://www.vianetz.com/license Commercial Software License
 */
class Vianetz_CheckoutAttributes_Helper_Log extends Mage_Core_Helper_Abstract
{
    /**
     * Log message to file if enabled in system configuration.
     *
     * @param string $message
     * @param int $type
     *
     * @return Vianetz_Core_Helper_Log
     */
    public function log($message, $type = LOG_DEBUG, $extensionNamespace = null)
    {
        $extensionVersion = Mage::getConfig()->getModuleConfig($extensionNamespace)->version;
        $message = $extensionNamespace . ' v' . $extensionVersion . ': ' . $message;
        $logFilename = $extensionNamespace . '.log';

        Mage::log($message, $type, $logFilename, true);

        return $this;
    }
}
