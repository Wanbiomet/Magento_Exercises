<?php
namespace Magenest\CustomKnockoutJs\Model\ResourceModel\Promotion;
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
        $this->_init('Magenest\CustomKnockoutJs\Model\Promotion',
            'Magenest\CustomKnockoutJs\Model\ResourceModel\Promotion');
    }

    protected function _initSelect()
    {
        parent::_initSelect();
        $this->joinCustomerGroup();

    }
    public function joinCustomerGroup()
    {
        // Join với bảng admin_user thông qua author_id
        $this->getSelect()->joinLeft(
            ['customer_group' => $this->getTable('customer_group')],
            'main_table.customer_group_id = customer_group.customer_group_id',
            ['customer_group_code' => 'customer_group.customer_group_code']
        );

        return $this;
    }
}
