<?php

class Vianetz_CheckoutAttributes_Model_Mysql4_Sales_Order extends Mage_Core_Model_Mysql4_Abstract
{
    /**
     * @return void
     */
    public function _construct()
    {
        $this->_init('vianetz_checkoutattributes/sales_order', 'id');
    }

    /**
     * @param $order_id
     * @param $var
     */
    public function deleteByOrder($orderId, $var)
    {
        $table = $this->getMainTable();
        $where = $this->_getWriteAdapter()->quoteInto('order_id = ? AND ', $orderId) . $this->_getWriteAdapter()->quoteInto('`key` = ?', $var);
        $this->_getWriteAdapter()->delete($table, $where);
    }

    /**
     * @param $order_id
     * @param string $var
     *
     * @return array
     */
    public function getByOrder($orderId, $var = '')
    {
        $table = $this->getMainTable();
        $where = $this->_getReadAdapter()->quoteInto('order_id = ?', $orderId);
        if (!empty($var)) {
            $where .= $this->_getReadAdapter()->quoteInto(' AND `key` = ? ', $var);
        }
        $sql = $this->_getReadAdapter()->select()->from($table)->where($where);
        $rows = $this->_getReadAdapter()->fetchAll($sql);
        $return = array();
        foreach ($rows as $row) {
            $return[$row['key']] = $row['value'];
        }
        return $return;
    }
}