<?php

namespace Magenest\Movie\Model\System\Config\Source;


use Magento\Framework\Data\OptionSourceInterface;
use Magento\Customer\Model\ResourceModel\Group\CollectionFactory;

class CustomerGroupName implements OptionSourceInterface
{

    protected $collectionFactory;




    public function __construct(
        CollectionFactory $collectionFactory,
    ) {
        $this->collectionFactory = $collectionFactory;

    }

    /**
     * Retrieve the number of rows in the magenest_actor table
     *
     * @return mixed
     */
    public function toOptionArray()
    {
        $options = [];
        try {
            $collection = $this->collectionFactory->create();
            foreach ($collection as $customerGroup) {
                $options[] = [
                    'value' => $customerGroup->getData('customer_group_id'),
                    'label' => $customerGroup->getData('customer_group_code')
                ];
            }
        }catch (\Exception $e){
            // Log the error for debugging
//            $this->_logger->error($e->getMessage());
        }

        return $options;
    }
}
