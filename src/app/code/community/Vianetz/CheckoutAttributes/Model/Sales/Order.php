<?php

class Vianetz_CheckoutAttributes_Model_Sales_Order extends Mage_Core_Model_Abstract
{
    /**
     *
     */
    public function _construct()
    {
        parent::_construct();
        $this->_init('vianetz_checkoutattributes/sales_order');
    }

    /**
     * @param $order_id
     * @param $var
     */
    public function deleteByOrder($orderId, $var)
    {
        $this->_getResource()->deleteByOrder($orderId, $var);
        
        return $this;
    }

    /**
     * Get variable from order.
     *
     * @param        $order_id
     * @param string $var
     *
     * @return mixed
     */
    public function getByOrder($orderId, $var = '')
    {
        return $this->_getResource()->getByOrder($orderId, $var);
    }
}