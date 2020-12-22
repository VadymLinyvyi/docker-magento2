<?php

namespace Elogic\Linkedin\Setup\Patch\Data;

use Elogic\Linkedin\Model\Attribute\Backend\Linkedin as LinkedinBackend;
use Magento\Customer\Setup\CustomerSetupFactory;
use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

/**
 * Class CreateProductAttribute
 * @package Elogic\Vendor\Setup\Patch\Data
 */
class CreateLinkedInAttribute implements DataPatchInterface
{
    /**
     * @var CustomerSetupFactory
     */
    protected $customerSetupFactory;

    /**
     * @var ModuleDataSetupInterface
     */
    protected $moduleDataSetup;

    /**
     * CreateLinkedInAttribute constructor.
     * @param CustomerSetupFactory $customerSetupFactory
     * @param ModuleDataSetupInterface $moduleDataSetup
     */
    public function __construct(
        CustomerSetupFactory $customerSetupFactory,
        ModuleDataSetupInterface $moduleDataSetup
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->customerSetupFactory = $customerSetupFactory;
    }

    /**
     * @inheritDoc
     */
    public static function getDependencies()
    {
        return [];
    }

    /**
     * @inheritDoc
     */
    public function getAliases()
    {
        return [];
    }

    /**
     * @inheritDoc
     */
    public function apply()
    {
        $customerSetup = $this->customerSetupFactory->create(['setup' => $this->moduleDataSetup]);
//        $customerSetup->removeAttribute('customer_address', 'linkedin_profile');
        $customerSetup->addAttribute(
            'customer_address',
            'linkedin_profile',
            [
                'label' => 'Linked In',
                'input' => 'text',
                'type' => Table::TYPE_TEXT,
                'source' => '',
                'required' => false,
                'position' => 75,
                'visible' => true,
                'system' => false,
                'is_used_in_grid' => true,
                'is_visible_in_grid' => true,
                'is_filterable_in_grid' => true,
                'is_searchable_in_grid' => true,
                'visible_on_front' => true,
                'frontend_input' => 'text',
                'backend' => LinkedinBackend::class,
                'frontend_class' => 'validate-url validate-length maximum-length-250'
            ]
        );
        $attribute = $customerSetup->getEavConfig()
            ->getAttribute('customer_address', 'linkedin_profile')
            ->addData(
                ['used_in_forms' =>
                    [
                        'adminhtml_customer_address',
                        'adminhtml_customer',
                        'adminhtml_checkout',
                        'customer_address_edit',
                        'customer_register_address',
                        'customer_address',
                        'customer_account_create',
                        'checkout_register'
                    ]
                ]
            );
        $attribute->save();
    }
}
