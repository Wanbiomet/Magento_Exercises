<?php
namespace Magenest\CustomCustomer\Plugin\Block\Checkout;

use Magento\Checkout\Block\Checkout\LayoutProcessor;
use Magenest\CustomCustomer\Model\Source\Region;
class LayoutProcessorPlugin
{
    protected $region;

    public function __construct(Region $region)
    {
        $this->region = $region;
    }
    /**
     * Checkout LayoutProcessor after process plugin.
     *
     * @param LayoutProcessor $processor
     * @param array $jsLayout
     * @return array
     */
    public function afterProcess(LayoutProcessor $processor, array $jsLayout): array
    {
        $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']
        ['children']['shippingAddress']['children']['shipping-address-fieldset']['children']
        ['vn_region'] = [
            'component' => 'Magento_Ui/js/form/element/select',
            'config' => [
                'customScope' => 'shippingAddress',
                'template' => 'ui/form/field',
                'elementTmpl' => 'ui/form/element/select',
                'id' => 'vn-region',
            ],
            'dataScope' => 'shippingAddress.vn_region',
            'label' => 'Region VN',
            'provider' => 'checkoutProvider',
            'visible' => true,
            'sortOrder' => 250,
            'id' => 'vn-region',
            'options' => $this->region->getAllOptions()
        ];

        $configuration = $jsLayout['components']['checkout']['children']['steps']['children']['billing-step']['children']['payment']['children']['payments-list']['children'];
        foreach ($configuration as $paymentGroup => $groupConfig) {
            if (isset($groupConfig['component']) AND $groupConfig['component'] === 'Magento_Checkout/js/view/billing-address') {
                $jsLayout['components']['checkout']['children']['steps']['children']['billing-step']['children']
                ['payment']['children']['payments-list']['children'][$paymentGroup]['children']['form-fields']['children']['vn_region'] = [
                    'component' => 'Magento_Ui/js/form/element/select',
                    'config' => [
                        'customScope' => 'billingAddress.custom_attributes',
                        'template' => 'ui/form/field',
                        'elementTmpl' => 'ui/form/element/select',
                        'id' => 'vn-region-billing-address',
                    ],
                    'dataScope' => 'billingAddress.custom_attributes.vn_region',
                    'label' => 'Region VN',
                    'provider' => 'checkoutProvider',
                    'visible' => true,
                    'sortOrder' => 250,
                    'id' => 'vn-region-billing-address',
                    'options' => $this->region->getAllOptions()
                ];
            }
        }
        return $jsLayout;
    }
}
