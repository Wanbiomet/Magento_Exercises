<?php
namespace Magenest\CustomKnockoutJs\Model\ResourceModel\Banner;
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
        $this->_init('Magenest\CustomKnockoutJs\Model\Banner',
            'Magenest\CustomKnockoutJs\Model\ResourceModel\Banner');
    }
}
