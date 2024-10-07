<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

declare (strict_types = 1);

namespace Magenest\CustomCustomer\Setup\Patch\Data;

use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;

class AddCustomerRegion implements DataPatchInterface {

    /**
     * ModuleDataSetupInterface
     *
     * @var ModuleDataSetupInterface
     */

    /**
     * EavSetupFactory
     *
     * @var EavSetupFactory
     */
    private $eavSetupFactory;

    /**
     * @param EavSetupFactory          $eavSetupFactory
     */
    public function __construct(
        EavSetupFactory $eavSetupFactory
    ) {
        $this->eavSetupFactory = $eavSetupFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function apply()
    {
        $eavSetup = $this->eavSetupFactory->create();

        // Add start_time attribute
        $eavSetup->addAttribute(
            \Magento\Customer\Model\Customer::ENTITY,
            'vn_region',
            [
                'type' => 'int',
                'label' => 'Region VN',
                'input' => 'select',
                'required' => false,
                'sort_order' => 50,
                'source' => 'Magenest\CustomCustomer\Model\Source\Region',
                'global' => ScopedAttributeInterface::SCOPE_GLOBAL,
                'filter_time' => true,
                'is_visible_in_grid' => true,
                'is_used_in_grid' => true,
                'visible_on_front' => true,
                'used_in_forms' => [
                    'adminhtml_customer_address',
                    'customer_address_edit',
                    'customer_register_address',
                    'checkout_register',
                    'checkout_billing_address',
                    'checkout_shipping_address'
                ]
            ]
        );


    }


    /**
     * {@inheritdoc}
     */
    public static function getDependencies() {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function getAliases() {
        return [];
    }
}
