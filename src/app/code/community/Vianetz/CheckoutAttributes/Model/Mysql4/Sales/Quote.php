<?php
/**
 * CheckoutAttributes Quote Resource Model
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