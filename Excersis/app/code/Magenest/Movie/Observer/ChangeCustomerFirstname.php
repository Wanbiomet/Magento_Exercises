<?php
namespace Magenest\Movie\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;


class ChangeCustomerFirstname implements ObserverInterface
{
    /**
     * Execute the observer
     *
     * @param Observer $observer
     * @return void
     */
    public function execute(Observer $observer)
    {
        // Get the customer object from the observer
        $customer = $observer->getEvent()->getCustomer();
        $customer->setFirstname('Magenest');
    }
}
