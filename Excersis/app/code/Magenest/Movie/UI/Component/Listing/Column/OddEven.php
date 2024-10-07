<?php

namespace Magenest\Movie\UI\Component\Listing\Column;

use Magento\Ui\Component\Listing\Columns\Column;

class OddEven extends Column
{
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$item) {
                $orderId = $item['entity_id'];
                if(isset($item['entity_id'])){
                    $item['odd_even'] = ($orderId % 2 == 0) ? '<span class="even success">Even</span>' : '<span class="odd error">Odd</span>';
                }

            }
        }
        return $dataSource;
    }
}
