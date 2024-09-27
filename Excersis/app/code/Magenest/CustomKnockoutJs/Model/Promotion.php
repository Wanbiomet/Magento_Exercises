<?php

namespace Magenest\CustomKnockoutJs\Model;

use Magento\Framework\Model\AbstractModel;

class Promotion extends AbstractModel
{
    protected function _construct()
    {
        $this->_init('Magenest\CustomKnockoutJs\Model\ResourceModel\Promotion');
    }
}
