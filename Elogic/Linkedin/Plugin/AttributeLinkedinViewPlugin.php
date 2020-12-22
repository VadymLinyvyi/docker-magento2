<?php

namespace Elogic\Linkedin\Plugin;

use Magento\Config\Model\Config;
use Magento\Customer\Setup\CustomerSetupFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;

/**
 * Class AttributeLinkedinViewPlugin
 * @package Elogic\Linkedin\Plugin
 */
class AttributeLinkedinViewPlugin
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
     * @var int
     */
    protected $attributeStatus;

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
     * @param Config $config
     * @param $result
     * @return mixed
     */
    public function afterSave(Config $config, $result)
    {
        $data = $result->getData('groups');
        $this->attributeStatus = array_shift($data['address']['fields']['linkedin']);
        $this->upgrade();
        return $result;
    }

    /**
     * Update Linkedin attribute parameters
     */
    public function upgrade()
    {
        $setup = $this->moduleDataSetup->startSetup();
        $customerSetup = $this->customerSetupFactory->create(['setup' => $setup]);
        $attributeCode = 'linkedin_profile';
        switch ($this->attributeStatus) {
            case 0:
                $customerSetup->updateAttribute(
                    'customer_address',
                    $attributeCode,
                    [
                        'is_visible' => false,
                        'is_required' => false
                    ]
                );
                break;
            case 1:
                $customerSetup->updateAttribute(
                    'customer_address',
                    $attributeCode,
                    [
                        'is_visible' => true,
                        'is_required' => false
                    ]
                );
                break;
            case 2:
                $customerSetup->updateAttribute(
                    'customer_address',
                    $attributeCode,
                    [
                        'is_visible' => true,
                        'is_required' => true
                    ]
                );
                break;
        }
        $setup->endSetup();
    }
}
