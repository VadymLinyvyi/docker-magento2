<?php

namespace Elogic\Linkedin\Plugin;

use Magento\Checkout\Block\Checkout\LayoutProcessor;
use Elogic\Linkedin\Model\Attribute\Helper\AttributeStatus;
use Elogic\Linkedin\Block\DataProviders\LinkedinAttributeData;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Class AddCheckoutFieldPlugin
 * @package Elogic\Linkedin\Plugin
 */
class AddCheckoutFieldPlugin
{
    const REQUIRED = 2;

    /**
     * @var AttributeStatus
     */
    private $attributeStatus;

    /**
     * @var LinkedinAttributeData
     */
    private $attributeData;

    /**
     * AddCheckoutFieldPlugin constructor.
     * @param AttributeStatus $attributeStatus
     * @param LinkedinAttributeData $attributeData
     */
    public function __construct(
        AttributeStatus $attributeStatus,
        LinkedinAttributeData $attributeData
    ) {
        $this->attributeStatus = $attributeStatus;
        $this->attributeData = $attributeData;
    }


    /**
     * @param LayoutProcessor $processor
     * @param array $jsLayout
     * @return array
     * @throws LocalizedException
     * @throws NoSuchEntityException
     */
    public function afterProcess(LayoutProcessor $processor, array $jsLayout)
    {
        $customAttributeCode = 'linkedin_profile';
        $validations = ['validate-url' => true, 'maxlength' => 250];
        $attributeStatus = $this->attributeStatus->getLinkedinAttributeStatus();
        if ($attributeStatus) {
            if ($attributeStatus == self::REQUIRED) {
                $validations ['required-entry'] = true;
            }
            $customField = [
                'component' => 'Magento_Ui/js/form/element/abstract',
                'config' => [
                    'customScope' => 'shippingAddress.custom_attributes',
                    'customEntry' => null,
                    'template' => 'ui/form/field',
                    'elementTmpl' => 'ui/form/element/input',
                    'tooltip' => [
                        'description' => 'for better prediction of products that may interest you',
                    ],
                    'id' => 'linkedin_profile'
                ],
                'dataScope' => 'shippingAddress.custom_attributes' . '.' . $customAttributeCode,
                'label' => 'Linkedin',
                'provider' => 'checkoutProvider',
                'options' => [],
                'visible' => true,
                'validation' => $validations,
                'sortOrder' => 250,
                'filterBy' => null,
                'customEntry' => null,
                'id' => 'linkedin_profile',
                'value' => $this->attributeData->getLinkedinAttributeData()
            ];
            $jsLayout['components']['checkout']['children']['steps']['children']
            ['shipping-step']['children']['shippingAddress']['children']['shipping-address-fieldset']
            ['children'][$customAttributeCode] = $customField;
        }
        return $jsLayout;
    }
}
