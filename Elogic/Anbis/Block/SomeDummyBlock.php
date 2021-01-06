<?php

namespace Elogic\Anbis\Block;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\View\Element\Template;
use Magento\Store\Model\ScopeInterface;

/**
 * Class SomeDummyBlock
 * @package Elogic\Anbis\Block
 */
class SomeDummyBlock extends Template
{
    const XML_PATH_DUMMY_BLOCK_DEFAULT_VALUE = 'web/my_group/dummy_block';

    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * SomeDummyBlock constructor.
     * @param ScopeConfigInterface $scopeConfig
     * @param Template\Context $context
     * @param array $data
     */
    public function __construct(ScopeConfigInterface $scopeConfig, Template\Context $context, array $data = [])
    {
        parent::__construct($context, $data);
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * @return array
     */
    public function getText()
    {
        $storeScope = ScopeInterface::SCOPE_STORE;
        $configValue = $this->scopeConfig->getValue(self::XML_PATH_DUMMY_BLOCK_DEFAULT_VALUE, $storeScope);
        return ['Some dummy text', $configValue?:' '];
    }
}
