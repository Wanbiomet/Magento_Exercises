<?php

namespace Magenest\CustomCustomer\Model\Source;

use Magento\Framework\Data\OptionSourceInterface;
use Magento\User\Model\ResourceModel\User\CollectionFactory as AuthorCollectionFactory;

class AuthorOptions implements OptionSourceInterface
{
    protected $collectionFactory;

    public function __construct(AuthorCollectionFactory $authorCollectionFactory)
    {
        $this->collectionFactory = $authorCollectionFactory;
    }

    public function toOptionArray()
    {
        $options = [];
        try {
            $collection = $this->collectionFactory->create();
            foreach ($collection as $author) {
                $options[] = [
                    'value' => $author->getData('user_id'),
                    'label' => $author->getData('username')
                ];
            }
        }catch (\Exception $e){
            // Log the error for debugging
//            $this->_logger->error($e->getMessage());
        }

        return $options;
    }
}
