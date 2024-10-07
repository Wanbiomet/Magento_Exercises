<?php

namespace Magenest\CustomCustomer\Model;

use Magento\Framework\Model\AbstractModel;

class Category extends AbstractModel
{
    protected function _construct()
    {
        $this->_init('Magenest\CustomCustomer\Model\ResourceModel\Category');
    }
}
