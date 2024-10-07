<?php
namespace Magenest\CustomKnockoutJs\Model\ResourceModel;
class Promotion extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb {
    public function _construct() {
        $this->_init('magenest_promotion',
            'id');
    }
}
