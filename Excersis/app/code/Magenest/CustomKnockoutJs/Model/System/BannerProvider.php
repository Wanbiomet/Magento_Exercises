<?php
namespace Magenest\CustomKnockoutJs\Model\System;

use Magenest\CustomKnockoutJs\Model\ResourceModel\Banner\CollectionFactory as BannerCollectionFactory;

class BannerProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{

    protected $_loadedData;
    protected $collection;
    protected $request;
    /**
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param BannerCollectionFactory $bannerCollectionFactory
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        BannerCollectionFactory $bannerCollectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $bannerCollectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
        if (isset($this->_loadedData)) {
            return $this->_loadedData;
        }
        $items = $this->collection->getItems();
        foreach ($items as $item) {
            $this->_loadedData[$item->getId()] = $item->getData();
        }
        return $this->_loadedData;
    }
}
