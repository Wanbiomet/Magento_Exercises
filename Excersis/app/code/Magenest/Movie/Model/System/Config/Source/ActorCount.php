<?php

namespace Magenest\Movie\Model\System\Config\Source;

use Magento\Framework\App\Config\Value;
use Magenest\Movie\Model\ResourceModel\Actor\CollectionFactory as ActorCollectionFactory;

class ActorCount extends Value
{

    protected $collectionFactory;

    protected $cacheTypeList;


    public function __construct(
        ActorCollectionFactory $collectionFactory,
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\App\Config\ScopeConfigInterface $config,
        \Magento\Framework\App\Cache\TypeListInterface $cacheTypeList,
        \Magento\Framework\Model\ResourceModel\AbstractResource $resource = null,
        \Magento\Framework\Data\Collection\AbstractDb $resourceCollection = null,
        array $data = []
    ) {
        $this->collectionFactory = $collectionFactory;
        $this->cacheTypeList = $cacheTypeList;
        parent::__construct($context, $registry, $config, $cacheTypeList, $resource, $resourceCollection, $data);
    }

    /**
     * Retrieve the number of rows in the magenest_actor table
     *
     * @return mixed
     */
    public function _afterLoad()
    {
        $collection = $this->collectionFactory->create();
        $count = $collection->getSize();

        $this->setValue($count);
        return $this;
    }
}
