<?php

class Vianetz_CheckoutAttributes_Model_Mysql4_Sales_Quote_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    /**
     * @return void
     */
    public function _construct()
    {
        parent::_construct();
        $this->_init('vianetz_checkoutattributes/sales_quote');
    }
}