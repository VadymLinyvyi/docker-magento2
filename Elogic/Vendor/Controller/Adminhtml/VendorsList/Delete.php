<?php
namespace Elogic\Vendor\Controller\Adminhtml\VendorsList;

use Exception;
use Magento\Backend\App\Action;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\Controller\ResultInterface;
use Elogic\Vendor\Api\VendorRepositoryInterfaceFactory;

/**
 * Class Delete
 * @package Elogic\Vendor\Controller\Adminhtml\VendorsList
 */
class Delete extends Action
{
    /**
     * @var VendorRepositoryInterfaceFactory
     */
    private $vendorRepository;

    /**
     * Delete constructor.
     * @param VendorRepositoryInterfaceFactory $vendorRepository
     * @param Action\Context $context
     */
    public function __construct(
        VendorRepositoryInterfaceFactory $vendorRepository,
        Action\Context $context
    ) {
        parent::__construct($context);
        $this->vendorRepository = $vendorRepository;
    }

    /**
     * {@inheritdoc}
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Elogic_Vendor::vendor_delete');
    }

    /**
     * Delete action
     *
     * @return ResultInterface
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        /** @var Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($id) {
            try {
                $vendor = $this->vendorRepository->getById($id);
                $this->vendorRepository->delete($vendor);
                $this->messageManager->addSuccessMessage(__('Vendor deleted'));
                return $resultRedirect->setPath('*/*/');
            } catch (Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
                return $resultRedirect->setPath('*/*/edit', ['id' => $id]);
            }
        }
        $this->messageManager->addErrorMessage(__('Vendor does not exist'));
        return $resultRedirect->setPath('*/*/');
    }
}
