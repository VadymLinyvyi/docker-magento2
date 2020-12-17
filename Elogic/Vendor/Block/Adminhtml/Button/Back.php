<?php
namespace Elogic\Vendor\Block\Adminhtml\Button;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;
use Magento\Backend\Block\Widget\Context;

/**
 * Class Back
 * @package Elogic\Vendor\Block\Adminhtml\Button
 */
class Back implements ButtonProviderInterface
{
    /**
     * @var Context
     */
    protected $context;

    /**
     * Generic constructor.
     * @param Context $context
     */
    public function __construct(
        Context $context
    ) {
        $this->context = $context;
    }

    /**
     * get button data
     *
     * @return array
     */
    public function getButtonData()
    {
        return [
            'label' => __('Back'),
            'on_click' => sprintf("location.href = '%s';", $this->getBackUrl()),
            'class' => 'back',
            'sort_order' => 10
        ];
    }

    /**
     * Get URL for back (reset) button
     *
     * @return string
     */
    public function getBackUrl()
    {
        return $this->context->getUrlBuilder()->getUrl('*/*/');
    }
}
