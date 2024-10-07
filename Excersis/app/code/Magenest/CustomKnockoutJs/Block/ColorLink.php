<?php
namespace Magenest\CustomKnockoutJs\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\App\Config\ScopeConfigInterface;

class ColorLink extends Template
{
    protected $scopeConfig;

    public function __construct(
        Template\Context $context,
        ScopeConfigInterface $scopeConfig,
        array $data = []
    ) {
        $this->scopeConfig = $scopeConfig;
        parent::__construct($context, $data);
    }

    public function getColors()
    {
        $colorData = $this->scopeConfig->getValue('custom_color_section/custom_color/color_picker_group', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        return json_decode($colorData, true); // Chuyển đổi từ JSON sang mảng
    }
}
