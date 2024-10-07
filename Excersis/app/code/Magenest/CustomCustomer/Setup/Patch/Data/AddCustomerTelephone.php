<?php
declare(strict_types=1);
namespace Magenest\CustomCustomer\Setup\Patch\Data;

use Magento\Customer\Model\Customer;
use Magento\Customer\Setup\CustomerSetupFactory;
use Magento\Customer\Api\CustomerMetadataInterface;
use Magento\Eav\Model\Config;
use Magento\Customer\Model\ResourceModel\Attribute as AttributeResource;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;

class AddCustomerTelephone implements DataPatchInterface
{
    private $moduleDataSetup;

    private $customerSetupFactory;
    private $eavConfig;
    /**
     * @var AttributeResource
     */
    private $attributeResource;
    /**
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param CustomerSetupFactory $customerSetupFactory
     * @param AttributeResource $attributeResource
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        CustomerSetupFactory $customerSetupFactory,
        AttributeResource $attributeResource,
        Config $eavConfig,
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->customerSetupFactory = $customerSetupFactory;
        $this->eavConfig = $eavConfig;
        $this->attributeResource = $attributeResource;
    }

    public function apply()
    {
        $this->moduleDataSetup->getConnection()->startSetup();

        $customerSetup = $this->customerSetupFactory->create(['setup' => $this->moduleDataSetup]);

        // Add the attribute
        $customerSetup->addAttribute(
            CustomerMetadataInterface::ENTITY_TYPE_CUSTOMER,
            'telephone',
            [
                'label' => 'Telephone',
                'input' => 'text',
                'type' => 'varchar',
                'backend' => '',
                'user_defined' => true,
                'required' => false,
                'position' => 333,
                'visible' => true,
                'system' => false,
                'is_used_in_grid' => true,
                'is_visible_in_grid' => true,
                'is_html_allowed_on_front' => true,
                'visible_on_front' => true,
                'is_filterable_in_grid' => true,
                'is_searchable_in_grid' => true,
            ]
        );
        // Add attribute to default attribute set and group
        $customerSetup->addAttributeToSet(
            CustomerMetadataInterface::ENTITY_TYPE_CUSTOMER,
            CustomerMetadataInterface::ATTRIBUTE_SET_ID_CUSTOMER,
            null,
            'telephone'
        );
        // Get the newly created attribute's model
        $attribute = $customerSetup->getEavConfig()
            ->getAttribute(CustomerMetadataInterface::ENTITY_TYPE_CUSTOMER, 'telephone');

        // Make attribute visible in Admin customer form
        $attribute->setData(
            'used_in_forms', [
            'customer_account_create',      // Registration form on frontend
            'customer_account_edit',        // Edit account form on frontend
            'adminhtml_customer',           // Customer form in admin
            'adminhtml_checkout',           // Admin create order
            'adminhtml_customer_address',   // Admin customer address form
            'customer_address_edit',        // Frontend address edit form
            'customer_register_address'     // Registration address form
        ]);
        // Save attribute using its resource model
        $this->attributeResource->save($attribute);
        $this->moduleDataSetup->getConnection()->endSetup();
    }
    public static function getDependencies()
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function getAliases()
    {
        return [];
    }
}
