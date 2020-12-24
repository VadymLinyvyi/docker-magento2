<?php

namespace Elogic\Linkedin\Block\Order;

use Magento\Backend\Block\Template;
use Magento\Directory\Helper\Data as DirectoryHelper;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Json\Helper\Data as JsonHelper;
use Magento\Sales\Api\OrderRepositoryInterface;

/**
 * Class LinkedinAttributeData
 * @package Elogic\Linkedin\Block\Order
 */
class LinkedinAttributeData extends Template
{
    /**
     * @var RequestInterface
     */
    protected $requestInterface;
    /**
     * @var OrderRepositoryInterface
     */
    private $orderRepositoryInterface;

    /**
     * LinkedinAttributeData constructor.
     * @param RequestInterface $requestInterface
     * @param OrderRepositoryInterface $orderRepositoryInterface
     * @param Template\Context $context
     * @param array $data
     * @param JsonHelper|null $jsonHelper
     * @param DirectoryHelper|null $directoryHelper
     */
    public function __construct(
        RequestInterface $requestInterface,
        OrderRepositoryInterface $orderRepositoryInterface,
        Template\Context $context,
        array $data = [],
        ?JsonHelper $jsonHelper = null,
        ?DirectoryHelper $directoryHelper = null
    ) {
        parent::__construct($context, $data, $jsonHelper, $directoryHelper);
        $this->requestInterface = $requestInterface;
        $this->orderRepositoryInterface = $orderRepositoryInterface;
    }


    /**
     * @return string
     */
    public function getLinkedinAttributeData()
    {
        $orderId = $this->requestInterface->getParam('order_id');
        $order = $this->orderRepositoryInterface->get($orderId);
        return $order->getData('linkedin_profile')? : '';
    }
}
