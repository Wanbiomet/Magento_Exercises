<?php

namespace Magenest\Movie\Model\System\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;
use Magenest\Movie\Model\ResourceModel\Director\CollectionFactory as DirectorCollectionFactory;

class DirectorOptions implements OptionSourceInterface
{
    protected $collectionFactory;

    public function __construct(DirectorCollectionFactory $directorCollectionFactory)
    {
        $this->collectionFactory = $directorCollectionFactory;
    }

    public function toOptionArray()
    {
        $options = [];
        try {
            $collection = $this->collectionFactory->create();
            foreach ($collection as $director) {
                $options[] = [
                    'value' => $director->getData('director_id'),
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
