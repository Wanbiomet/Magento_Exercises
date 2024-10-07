<?php

namespace Magenest\CustomKnockoutJs\Block;

use Magento\Framework\View\Element\Template;
use Magento\Checkout\Model\Session as CheckoutSession;

class CustomCart extends Template
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
        return $this->checkoutSession->getQuote()->getAllVisibleItems();
    }
}
