<?php

class Vianetz_CheckoutAttributes_Model_Mysql4_Sales_Quote extends Mage_Core_Model_Mysql4_Abstract
{
    /**
     * @return void
     */
    public function _construct()
    {
        $this->_init('vianetz_checkoutattributes/sales_quote', 'id');
    }

    /**
     * @param $quote_id
     * @param $var
     */
    public function deleteByQuote($quote_id, $var)
    {
        $table = $this->getMainTable();
        $where = $this->_getWriteAdapter()->quoteInto('quote_id = ? AND ', $quote_id) . $this->_getWriteAdapter()->quoteInto('`key` = ? 	', $var);
        $this->_getWriteAdapter()->delete($table, $where);
    }

    /**
     * @param $quote_id
     * @param string $var
     *
     * @return array
     */
    public function getByQuote($quote_id, $var = '')
    {
        $table = $this->getMainTable();
        $where = $this->_getReadAdapter()->quoteInto('quote_id = ?', $quote_id);
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