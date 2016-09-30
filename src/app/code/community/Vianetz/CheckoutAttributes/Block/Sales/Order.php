<?php
/**
 * CheckoutAttributes Sales Order Block
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
 * @package     Vianetz_CheckoutAttributes
 * @author      Christoph Massmann, <C.Massmann@vianetz.com>
 * @link        http://www.vianetz.com
 * @copyright   Copyright (c) 2006-16 vianetz - C. Massmann (http://www.vianetz.com)
 * @license     http://www.gnu.org/licenses/gpl-2.0.txt GNU GENERAL PUBLIC LICENSE
 * @version     %%MODULE_VERSION%%
 */
class Vianetz_CheckoutAttributes_Block_Sales_Order extends Mage_Core_Block_Template
{
    /**
     * @return Vianetz_CheckoutAttributes_Model_Sales_Order
     */
    public function getCustomVars()
    {
        return Mage::getModel('vianetz_checkoutattributes/sales_order')
            ->getByOrder($this->getOrder()->getId());
    }

    /**
     * @return Mage_Sales_Model_Order
     */
    public function getOrder()
    {
        return Mage::registry('current_order');
    }
}