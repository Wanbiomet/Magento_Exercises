<?php
namespace Magenest\Movie\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;


class SetMovieRating implements ObserverInterface
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
        $movie = $observer->getEvent()->getData('movie');
        $movie->setData('rating',0);
    }
}
