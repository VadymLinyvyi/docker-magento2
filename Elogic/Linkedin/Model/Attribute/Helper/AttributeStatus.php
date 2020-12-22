<?php

namespace Elogic\Linkedin\Model\Attribute\Helper;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

/**
 * Class AttributeStatus
 * @package Elogic\Linkedin\Model\Attribute\Helper
 */
class AttributeStatus
{
    const XML_PATH_LINKEDIN_ATTRIBUTE_STATUS = 'customer/address/linkedin';

    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * AttributeStatus constructor.
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(ScopeConfigInterface $scopeConfig)
    {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * @return int
     */
    public function getLinkedinAttributeStatus()
    {
        $storeScope = ScopeInterface::SCOPE_STORE;
        return $this->scopeConfig->getValue(self::XML_PATH_LINKEDIN_ATTRIBUTE_STATUS, $storeScope);
    }
}
