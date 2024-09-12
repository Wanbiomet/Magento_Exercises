<?php

namespace Magenest\Movie\Model\System\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;
use Magenest\Movie\Model\ResourceModel\Movie\CollectionFactory as MovieCollectionFactory;

class Movie implements OptionSourceInterface
{
    protected $collectionFactory;

    public function __construct(MovieCollectionFactory $movieCollectionFactory)
    {
        $this->collectionFactory = $movieCollectionFactory;
    }

    public function toOptionArray()
    {
        $options = [];
        try {
            $collection = $this->collectionFactory->create();
            foreach ($collection as $director) {
                $options[] = [
                    'value' => $director->getData('movie_id'),
                    'label' => $director->getData('name')
                ];
            }
        }catch (\Exception $e){
            // Log the error for debugging
//            $this->_logger->error($e->getMessage());
        }

        return $options;
    }
}
