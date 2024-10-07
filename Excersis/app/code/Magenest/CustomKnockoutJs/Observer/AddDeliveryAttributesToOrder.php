<?php

namespace Magenest\CustomKnockoutJs\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class AddDeliveryAttributesToOrder implements ObserverInterface
{
    public function execute(Observer $observer)
    {
        $order = $observer->getEvent()->getOrder();
        $quote = $observer->getEvent()->getQuote();

        foreach ($quote->getAllItems() as $item) {
            // Kiểm tra xem mục có thuộc tính giao hàng và lưu chúng vào mục đơn hàng
            if ($deliveryTime = $quote->getData('delivery_time')) {
                $orderItem = $order->getItemById($item->getId());
                $orderItem->setData('delivery_time', $deliveryTime);
            }

            if ($deliveryDate = $quote->getData('delivery_date')) {
                $orderItem->setData('delivery_date', $deliveryDate);
            }
        }
    }
}
