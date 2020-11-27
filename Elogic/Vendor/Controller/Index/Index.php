<?php

namespace Elogic\Vendor\Controller\Index;


use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;


class Index extends \Magento\Framework\App\Action\Action
{
    /**
     * Booking action
     *
     * @return string
     */

    /**
     * @var \Elogic\Vendor\Model\VendorFactory
     */
    private $vendorFactory;

    public function __construct(
        Context $context,
        \Elogic\Vendor\Model\VendorFactory $vendorFactory
    )
    {
        $this->VendorFactory = $vendorFactory;
        parent::__construct($context);
    }


    public function execute()
    {

    }
}
