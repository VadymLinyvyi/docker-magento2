<?php

namespace Elogic\Linkedin\Setup\Patch\Data;

use Elogic\Linkedin\Model\Attribute\Backend\Linkedin as LinkedinBackend;
use Exception;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Eav\Model\Config;
use Magento\Customer\Model\Customer;
use Magento\Framework\DB\Ddl\Table;

/**
 * Class CreateProductAttribute
 * @package Elogic\Vendor\Setup\Patch\Data
 */
class CreateLinkedInAttribute implements DataPatchInterface
{
    /**
     * @var EavSetupFactory
     */
    protected $eavSetupFactory;

    /**
     * @var ModuleDataSetupInterface
     */
    protected $moduleDataSetup;

    /**
     * @var Config
     */
    private $eavConfig;

    /**
     * CreateLinkedInAttribute constructor.
     * @param EavSetupFactory $eavSetupFactory
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param Config $eavConfig
     */
    public function __construct(
        EavSetupFactory $eavSetupFactory,
        ModuleDataSetupInterface $moduleDataSetup,
        Config $eavConfig
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->eavSetupFactory = $eavSetupFactory;
        $this->eavConfig = $eavConfig;
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
     * @throws LocalizedException
     * @throws Exception
     */
    public function apply()
    {
        $customerSetup = $this->eavSetupFactory->create(['setup' => $this->moduleDataSetup]);
        $customerSetup->addAttribute(
            Customer::ENTITY,
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
        $attribute = $this->eavConfig
            ->getAttribute(Customer::ENTITY, 'linkedin_profile')
            ->addData(
                ['used_in_forms' =>
                    [
                        'adminhtml_customer',
                        'adminhtml_checkout',
                        'customer_register_address',
                        'customer_address',
                        'customer_account_create',
                        'customer_account_edit',
                        'checkout_register'
                    ]
                ]
            );
        $attribute->save();
    }
}
