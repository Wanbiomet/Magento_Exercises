<?php
namespace Magenest\CustomCustomer\Model\Source;

use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;

class Region extends AbstractSource
{
    public function getAllOptions()
    {
        return [
        ['label' => __('North'), 'value' => 1],
        ['label' => __('Central'), 'value' => 2],
        ['label' => __('South'), 'value' => 3],
        ];
    }
}
