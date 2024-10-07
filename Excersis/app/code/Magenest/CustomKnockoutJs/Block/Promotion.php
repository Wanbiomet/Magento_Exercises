<?php

namespace Magenest\CustomKnockoutJs\Block;

use Magento\Framework\View\Element\Template;
use Magenest\CustomKnockoutJs\Model\ResourceModel\Promotion\CollectionFactory;

class Promotion extends Template
{

    protected $collectionFactory;
    public function __construct(
        Template\Context $context,
        CollectionFactory $collectionFactory,
        array $data = []
    ) {
        $this->collectionFactory = $collectionFactory;
        parent::__construct($context, $data);
    }

    public function getPromotions(){
        $collection = $this->collectionFactory->create();

        return $collection;
    }
}
