<?php
namespace Magenest\Movie\Model\ResourceModel\Movie;
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
        $this->_init('Magenest\Movie\Model\Movie',
            'Magenest\Movie\Model\ResourceModel\Movie');
    }
}
