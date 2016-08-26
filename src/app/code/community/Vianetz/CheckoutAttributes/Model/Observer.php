<?php

class Vianetz_CheckoutAttributes_Model_Observer extends Mage_Core_Model_Observer
{
    /**
     * This function is called just before $quote object get stored to database.
     * Here, from POST data, we capture our custom field and put it in the quote object
     *
     * @param Varien_Event_Observer $observer
     *
     * @return Vianetz_CheckoutAttributes_Model_Observer
     */
    public function saveQuoteBefore(Varien_Event_Observer $observer)
    {
        /** @var Mage_Sales_Model_Quote $quote */
        $quote = $observer->getQuote();
        $post = Mage::app()->getFrontController()->getRequest()->getPost();

        foreach (Mage::helper('vianetz_checkoutattributes')->getCustomAttributes() as $attributeName) {
            $postValue = $post['vianetz_checkoutattributes'][$attributeName];
            $quoteValue = $quote->getData($attributeName);
            if (empty($postValue) === false) {
                $value = $postValue;
            } else if (empty($quoteValue) === false) {
                $value = $quoteValue;
            } else {
                continue;
            }

            $quote->setData($attributeName, $value);
        }

        return $this;
    }

    /**
     * This function is called, just after $quote object get saved to database.
     * Here, after the quote object gets saved in database
     * we save our custom field in the our table created i.e sales_quote_custom
     *
     * @param Varien_Event_Observer $observer
     *
     * @return Vianetz_CheckoutAttributes_Model_Observer
     */
    public function saveQuoteAfter(Varien_Event_Observer $observer)
    {
        /** @var Mage_Sales_Model_Quote $quote */
        $quote = $observer->getQuote();

        foreach (Mage::helper('vianetz_checkoutattributes')->getCustomAttributes() as $attributeName) {
            $value = $quote->getData($attributeName);
            if (empty($value) === true) {
                continue;
            }

            Mage::getModel('vianetz_checkoutattributes/sales_quote')
                ->deleteByQuote($quote->getId(), $attributeName)
                ->setQuoteId($quote->getId())
                ->setKey($attributeName)
                ->setValue($value)
                ->save();
        }

        return $this;
    }

    /**
     * When load() function is called on the quote object,
     * we read our custom fields value from database and put them back in quote object.
     *
     * @param Varien_Event_Observer $observer
     *
     * @return Vianetz_CheckoutAttributes_Model_Observer
     */
    public function loadQuoteAfter(Varien_Event_Observer $observer)
    {
        /** @var Mage_Sales_Model_Quote $quote */
        $quote = $observer->getQuote();
        $data = Mage::getModel('vianetz_checkoutattributes/sales_quote')->getByQuote($quote->getId());

        foreach ($data as $key => $value) {
            $quote->setData($key, $value);
        }

        return $this;
    }

    /**
     * This function is called after order gets saved to database.
     * Here we transfer our custom fields from quote table to order table i.e sales_order_custom
     *
     * Event: sales_order_save_after
     *
     * @param Varien_Event_Observer $observer
     *
     * @return Vianetz_CheckoutAttributes_Model_Observer
     */
    public function saveOrderAfter(Varien_Event_Observer $observer)
    {
        $order = $observer->getOrder();
        /** @var Mage_Sales_Model_Quote $quote */
        $quote = $order->getQuote();

        if (empty($quote) === true) {
            return $this;
        }

        foreach (Mage::helper('vianetz_checkoutattributes')->getCustomAttributes() as $attributeName) {
            $quoteValue = $quote->getData($attributeName);
            $orderValue = $order->getData($attributeName);
            if (empty($quoteValue) === false && empty($orderValue) === true) {
                Mage::getModel('vianetz_checkoutattributes/sales_order')
                    ->deleteByOrder($order->getId(), $attributeName)
                    ->setOrderId($order->getId())
                    ->setKey($attributeName)
                    ->setValue($quoteValue)
                    ->save();

                $order->setData($attributeName, $quoteValue);
            }
        }

        return $this;
    }

    /**
     * This function is called when $order->load() is done.
     * Here we read our custom fields value from database and set it in order object.
     *
     * @param Varien_Event_Observer $observer
     *
     * @return Vianetz_CheckoutAttributes_Model_Observer
     */
    public function loadOrderAfter(Varien_Event_Observer $observer)
    {
        /** @var Mage_Sales_Model_Order $order */
        $order = $observer->getOrder();
        $data = Mage::getModel('vianetz_checkoutattributes/sales_order')->getByOrder($order->getId());

        foreach ($data as $key => $value) {
            $order->setData($key, $value);
        }

        return $this;
    }
}