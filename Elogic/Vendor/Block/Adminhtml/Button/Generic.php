<?php
namespace Elogic\Vendor\Block\Adminhtml\Button;

use Magento\Backend\Block\Widget\Context;
use Elogic\Vendor\Model\Vendor;

/**
 * Class Generic
 * @package Elogic\Vendor\Block\Adminhtml\Button
 */
class Generic
{
    /**
     * @var Context
     */
    protected $context;

    /**
     * @var Vendor
     */
    protected $model;

    /**
     * Generic constructor.
     * @param Context $context
     * @param Vendor $model
     */
    public function __construct(
        Context $context,
        Vendor $model
    ) {
        $this->context = $context;
        $this->model = $model;
    }

    /**
     * Generate url by route and parameters
     *
     * @param   string $route
     * @param   array $params
     * @return  string
     */
    public function getUrl($route = '', $params = [])
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }
}
