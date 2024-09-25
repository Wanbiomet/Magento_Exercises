<?php
namespace Magenest\CustomCustomer\Model\ResourceModel\Blog;
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
        $this->_init('Magenest\CustomCustomer\Model\Blog',
            'Magenest\CustomCustomer\Model\ResourceModel\Blog');
    }
    protected function _initSelect()
    {
       parent::_initSelect();
       $this->joinAuthorData();

    }
    public function joinAuthorData()
    {
        // Join với bảng admin_user thông qua author_id
        $this->getSelect()->joinLeft(
            ['admin_user' => $this->getTable('admin_user')],
            'main_table.author_id = admin_user.user_id',
            ['author_name' => 'admin_user.username']
        );

        return $this;
    }
}
