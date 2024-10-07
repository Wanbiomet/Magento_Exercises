<?php
namespace Magenest\CustomKnockoutJs\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\App\RequestInterface;

class AddDeliveryTime implements ObserverInterface
{
    protected $request;

    public function __construct(RequestInterface $request)
    {
        $this->request = $request;
    }
    public function execute(Observer $observer)
    {
        $quoteItem = $observer->getEvent()->getData('quote_item');
        $requestParams = $this->request->getParams();

        if (isset($requestParams['delivery_time'])) {
            $quoteItem->setData('delivery_time',$requestParams['delivery_time']);
        }

        if (isset($requestParams['delivery_date'])) {
            $quoteItem->setData('delivery_date',$requestParams['delivery_date']);
        }
    }
}
