<?php

namespace Magenest\CustomKnockoutJs\Model\Source;

use Magento\Framework\Data\OptionSourceInterface;
use Magento\Customer\Model\ResourceModel\Group\Collection;

class CustomerGroupOptions implements OptionSourceInterface
{
    /**
     * @var Collection
     */
    protected $customerGroupCollectionFactory;

    /**
     * Constructor
     *
     * @param Collection $customerGroupCollectionFactory
     */
    public function __construct(Collection $customerGroupCollectionFactory)
    {
        $this->customerGroupCollectionFactory = $customerGroupCollectionFactory;
    }

    /**
     * Retrieve options as array
     *
     * @return array
     */
    public function toOptionArray()
    {



        // Return the option array
        return $this->customerGroupCollectionFactory->toOptionArray();
    }
}
