<?php
namespace Magenest\Movie\Model\ResourceModel\Director;
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
        $this->_init('Magenest\Movie\Model\Director',
            'Magenest\Movie\Model\ResourceModel\Director');
    }
}
