<?php
class Vianetz_CheckoutAttributes_Block_Sales_Order extends Mage_Adminhtml_Block_Sales_Order_Abstract
{
    /**
     * @return array();
     */
    public function getCustomVars()
    {
        /** @var Vianetz_CheckoutAttributes_Model_Sales_Order $model */
        $model = Mage::getModel('vianetz_checkoutattributes/sales_order');
        try {
            return $model->getByOrder($this->getOrder()->getId());
        } catch (Exception $exception) {}

        return array();
    }
}