<?php

class Vianetz_CheckoutAttributes_Model_Sales_Quote extends Mage_Core_Model_Abstract
{

    public function _construct()
    {
        parent::_construct();
        $this->_init('vianetz_checkoutattributes/sales_quote');
    }

    public function deleteByQuote($quoteId, $var)
    {
        $this->_getResource()->deleteByQuote($quoteId, $var);

        return $this;
    }

    /**
     * @param $quoteId
     * @param string $var
     *
     * @return mixed
     */
    public function getByQuote($quoteId, $var = '')
    {
        return $this->_getResource()->getByQuote($quoteId, $var);
    }
}