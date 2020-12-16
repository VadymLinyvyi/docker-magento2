<?php
namespace Elogic\Vendor\Controller\Adminhtml\VendorsList;

use Magento\Backend\App\Action;
use Magento\Backend\Model\View\Result\Page;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\Redirect as ResultRedirect;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
use Elogic\Vendor\Api\Data\VendorInterface;
use Elogic\Vendor\Api\VendorRepositoryInterface;

/**
 * Class Edit
 * @package Elogic\Vendor\Controller\Adminhtml\VendorsList
 */
class Edit extends Action
{

    /**
     * Core registry
     *
     * @var Registry
     */
    protected $_coreRegistry = null;

    /**
     * @var PageFactory
     */
    protected $_resultPageFactory;

    /**
     * @var VendorInterface;
     */
    private $vendor;

    /**
     * @var VendorRepositoryInterface
     */
    private $vendorRepository;

    /**
     * Edit constructor.
     * @param Action\Context $context
     * @param PageFactory $resultPageFactory
     * @param Registry $registry
     * @param VendorInterface $vendor
     * @param VendorRepositoryInterface $vendorRepository
     */
    public function __construct(
        Action\Context $context,
        PageFactory $resultPageFactory,
        Registry $registry,
        VendorInterface $vendor,
        VendorRepositoryInterface $vendorRepository
    ) {
        $this->_resultPageFactory = $resultPageFactory;
        $this->_coreRegistry = $registry;
        $this->vendor = $vendor;
        $this->vendorRepository = $vendorRepository;
        parent::__construct($context);
    }

    /**
     * {@inheritdoc}
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Elogic_Vendor::vendor_save');
    }

    /**
     * Init actions
     *
     * @return Page
     */
    protected function _initAction()
    {
        // load layout, set active menu and breadcrumbs
        /** @var Page $resultPage */
        $resultPage = $this->_resultPageFactory->create();
        $resultPage->setActiveMenu('Elogic_Vendor::vendors')
            ->addBreadcrumb(__('Vendors'), __('Vendors'))
            ->addBreadcrumb(__('Manage Vendors List'), __('Manage Vendors List'));
        return $resultPage;
    }

    /**
     * @return Page|ResponseInterface|ResultRedirect|ResultInterface
     * @throws NoSuchEntityException
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        $vendor = $this->vendor;
        // If got an id, it's edition
        if ($id) {
            $vendor = $this->vendorRepository->getById($id);
            if (!$vendor->getEntityId()) {
                $this->messageManager->addErrorMessage(__('This vendor not exists.'));
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }
        $data = $this->_getSession()->getFormData(true);
        if (!empty($data)) {
            $vendor->setData($data);
        }
        $this->_coreRegistry->register('elogic_vendor_list', $vendor);
        $resultPage = $this->_initAction();
        $resultPage->addBreadcrumb(
            $id ? __('Edit Vendor') : __('New Vendor'),
            $id ? __('Edit Vendor') : __('New Vendor')
        );
        $resultPage->getConfig()->getTitle()->prepend(__('Vendors'));
        $resultPage->getConfig()->getTitle()
            ->prepend($vendor->getEntityId() ? $vendor->getName() : __('New Vendor'));
        return $resultPage;
    }
}
