<?php

namespace Magenest\Movie\UI\Component\Listing\Column;

use Magento\Ui\Component\Listing\Columns\Column;

class Ratings extends Column
{
    public function prepareDataSource(array $dataSource)
    {
        if(isset($dataSource['data']['items'])){
            foreach($dataSource['data']['items'] as &$item){
                if(isset($item['rating'])){
                    $data = [];
                    $starOf5 = ceil($item['rating']/2) ;

                    for($i = 1; $i <= 5; $i++)
                        if($starOf5 > 0 && $i <= $starOf5)
                            $data[] = '<span style="color: rgb(255 17 17); font-size: 25px;">&#9733;</span>';
                        else
                            $data[] = '<span style="color: rgb(204, 204, 204); font-size: 25px;">&#9733;</span>';

                    $item['rating'] = implode(' ',$data);
                }
            }
        }
        return parent::prepareDataSource($dataSource);
    }

}
