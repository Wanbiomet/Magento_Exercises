<?php

namespace Magenest\Movie\Model\System\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;
use Magenest\Movie\Model\ResourceModel\Actor\CollectionFactory as ActorCollectionFactory;

class Actor implements OptionSourceInterface
{
    protected $collectionFactory;

    public function __construct(ActorCollectionFactory $actorCollectionFactory)
    {
        $this->collectionFactory = $actorCollectionFactory;
    }

    public function toOptionArray()
    {
        $options = [];
        try {
            $collection = $this->collectionFactory->create();
            foreach ($collection as $director) {
                $options[] = [
                    'value' => $director->getData('actor_id'),
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
