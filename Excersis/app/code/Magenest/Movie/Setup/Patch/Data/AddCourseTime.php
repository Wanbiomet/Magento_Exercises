<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

declare (strict_types = 1);

namespace Magenest\Movie\Setup\Patch\Data;

use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;

class AddCourseTime implements DataPatchInterface {

    /**
     * ModuleDataSetupInterface
     *
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;

    /**
     * EavSetupFactory
     *
     * @var EavSetupFactory
     */
    private $eavSetupFactory;

    /**
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param EavSetupFactory          $eavSetupFactory
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        EavSetupFactory $eavSetupFactory
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->eavSetupFactory = $eavSetupFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function apply()
    {
        $eavSetup = $this->eavSetupFactory->create();

        // Add start_time attribute
//        $eavSetup->addAttribute(
//            \Magento\Catalog\Model\Product::ENTITY,
//            'course_start_time',
//            [
//                'type' => 'datetime',
//                'label' => 'Course Start Time',
//                'input' => 'date',
//                'required' => false,
//                'sort_order' => 50,
//                'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
//                'group' => 'General',
//                'backend' => \Magento\Eav\Model\Entity\Attribute\Backend\Datetime::class,
//                'filter_time' => true,
//                'is_visible_in_grid' => true,
//                'is_used_in_grid' => true,
//            ]
//        );
//
//        // Add end_time attribute
//        $eavSetup->addAttribute(
//            \Magento\Catalog\Model\Product::ENTITY,
//            'course_end_time',
//            [
//                'type' => 'datetime',
//                'label' => 'Course End Time',
//                'input' => 'date',
//                'required' => false,
//                'sort_order' => 60,
//                'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
//                'group' => 'General',
//                'backend' => \Magento\Eav\Model\Entity\Attribute\Backend\Datetime::class,
//                'filter_time' => true,
//                'is_visible_in_grid' => true,
//                'is_used_in_grid' => true,
//            ]
//        );
        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Product::ENTITY,
            'course_link',
            [
                'type' => 'text',
                'label' => 'Course Link',
                'input' => 'text',
                'required' => false,
                'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
                'visible' => true,
                'user_defined' => true,
                'group' => 'General',
                'is_visible_in_grid' => true,
                'is_used_in_grid' => true,
            ]
        );

        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Product::ENTITY,
            'course_document',
            [
                'type' => 'varchar',
                'label' => 'Course Document',
                'input' => 'file',
                'backend'=> 'Magenest\Movie\Model\Product\Attribute\Backend\File',
                'required' => false,
                'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
                'visible' => true,
                'user_defined' => true,
                'group' => 'General',
                'is_visible_in_grid' => true,
                'is_used_in_grid' => true,
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
