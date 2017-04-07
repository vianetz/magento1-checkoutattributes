<?php
/**
 * CheckoutAttributes Helper
 *
 * @section LICENSE
 * This file is created by vianetz <info@vianetz.com>.
 * The Magento module is distributed under GNU General Public License.
 *
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@vianetz.com so we can send you a copy immediately.
 *
 * @category    Vianetz
 * @package     Vianetz_CheckoutAttributes
 * @author      Christoph Massmann, <C.Massmann@vianetz.com>
 * @link        http://www.vianetz.com
 * @copyright   Copyright (c) since 2006 vianetz - C. Massmann (http://www.vianetz.com)
 * @license     http://www.gnu.org/licenses/gpl-2.0.txt GNU GENERAL PUBLIC LICENSE
 */
class Vianetz_CheckoutAttributes_Helper_Data extends Mage_Core_Helper_Abstract
{
    /**
     * @var string
     */
    const CUSTOM_ATTRIBUTES_XML_CONFIG_PATH = 'vianetz_checkoutattributes/custom_attributes';
    
    /**
     * Log message to file if enabled in system configuration.
     *
     * @param string $message
     * @param int $type
     *
     * @return Vianetz_CheckoutAttributes_Helper_Data
     */
    public function log($message, $type = LOG_DEBUG)
    {
        Mage::helper('vianetz_core/log')->log($message, $type, 'Vianetz_CheckoutAttributes');
        return $this;
    }

    /**
     * @return array
     */
    public function getCustomAttributes()
    {
        return explode(',', Mage::getStoreConfig(self::CUSTOM_ATTRIBUTES_XML_CONFIG_PATH));
    }
}