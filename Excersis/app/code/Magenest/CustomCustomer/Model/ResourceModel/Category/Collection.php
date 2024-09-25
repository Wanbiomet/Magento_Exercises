<?php
namespace Magenest\CustomCustomer\Model\ResourceModel\Category;
use \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
/**
 * create Collection
 */
class Collection extends AbstractCollection {
    /**
     * Initialize resource collection
     *
     * @return void
     */
    public function _construct() {
        $this->_init('Magenest\CustomCustomer\Model\Category',
            'Magenest\CustomCustomer\Model\ResourceModel\Category');
    }
}
