<?php
namespace Elogic\Vendor\Controller\Adminhtml\VendorsList;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Backend\App\Action;

/**
 * Class Index
 * @package Elogic\Vendor\Controller\Adminhtml\VendorsList
 */
class Index extends Action
{
    const ADMIN_RESOURCE = 'Elogic_Vendor::manage_vendors';

    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     * Index action
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Elogic_Vendor::manage_vendors');
        $resultPage->addBreadcrumb(__('Vendors'), __('Vendors'));
        $resultPage->addBreadcrumb(__('Manage Vendors List'), __('Manage Vendors List'));
        $resultPage->getConfig()->getTitle()->prepend(__('Vendors'));

        return $resultPage;
    }
}
