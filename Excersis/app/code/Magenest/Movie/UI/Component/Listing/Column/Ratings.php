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
                    $starRatings = $item['rating']/2 ;

                    for($i = 1; $i <= 5; $i++)
                        if($starRatings < $i){
                            if(is_float($starRatings) && (round($starRatings) == $i)){
                                //half star
                                $data[] = '
                                        <span style="display: inline-block; font-size: 25px; color: rgb(204, 204, 204); position: relative;">
                                            &#9733;
                                            <span style="position: absolute; top: 0; left: 4%; width: 50%; overflow: hidden; color: rgb(255 17 17);">&#9733;</span>
                                        </span>';
                            }else{
                                //no star
                                $data[] = '<span style="color: rgb(204, 204, 204); font-size: 25px;">&#9733;</span>';
                            }
                        }else{
                            //full star
                            $data[] = '<span style="color: rgb(255 17 17); font-size: 25px;">&#9733;</span>';
                        }
                    $item['rating'] = implode(' ',$data);
                }
            }
        }
        return parent::prepareDataSource($dataSource);
    }

}
