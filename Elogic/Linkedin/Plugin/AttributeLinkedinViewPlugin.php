<?php

namespace Elogic\Linkedin\Plugin;

use Elogic\Linkedin\Model\Config\Source\NoOptionalRequired;
use Magento\Config\Model\Config;
use Magento\Customer\Model\Customer;
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
        if (isset($data['address']['fields']['linkedin'])) {
            $this->attributeStatus = array_shift($data['address']['fields']['linkedin']);
            $this->upgrade();
        }
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
            case NoOptionalRequired::IS_INVISIBLE:
                $customerSetup->updateAttribute(
                    Customer::ENTITY,
                    $attributeCode,
                    [
                        'is_visible' => false,
                        'visible_on_front' => false,
                        'is_required' => false
                    ]
                );
                break;
            case NoOptionalRequired::IS_OPTIONAL:
                $customerSetup->updateAttribute(
                    Customer::ENTITY,
                    $attributeCode,
                    [
                        'is_visible' => true,
                        'visible_on_front' => true,
                        'is_required' => false
                    ]
                );
                break;
            case NoOptionalRequired::IS_REQUIRED:
                $customerSetup->updateAttribute(
                    Customer::ENTITY,
                    $attributeCode,
                    [
                        'is_visible' => true,
                        'visible_on_front' => true,
                        'is_required' => true
                    ]
                );
                break;
        }
        $setup->endSetup();
    }
}
