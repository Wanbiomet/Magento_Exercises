<?php

namespace Magenest\CustomKnockoutJs\Block;

use Magento\Framework\View\Element\Template;
use Magento\Checkout\Model\Session as CheckoutSession;

class CustomOrder extends Template
{
    protected $checkoutSession;

    public function __construct(
        Template\Context $context,
        CheckoutSession $checkoutSession,
        array $data = []
    ) {
        $this->checkoutSession = $checkoutSession;
        parent::__construct($context, $data);
    }

    public function getQuoteItems()
    {
        $quote = $this->checkoutSession->getQuote();
        $deliveryInfo = [];

        foreach ($quote->getAllVisibleItems() as $item) {
            $deliveryInfo[] = [
                'delivery_time' => $item->getData('delivery_time'),
                'delivery_date' => $item->getData('delivery_date'),
            ];
        }

        return $deliveryInfo;
    }
}
