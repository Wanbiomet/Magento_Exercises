<?php

namespace Magenest\Movie\Model\System\Config\Source;

use Magento\Framework\Option\ArrayInterface;

class Options implements ArrayInterface
{
    /**
     * Retrieve option array for select field
     *
     * @return array
     */
    public function toOptionArray()
    {
        return [
            ['value' => '1', 'label' => __('Show')],
            ['value' => '2', 'label' => __('Not Show')],
        ];
    }
}
