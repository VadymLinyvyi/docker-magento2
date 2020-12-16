<?php
namespace Elogic\Vendor\Controller\Adminhtml\VendorsList;

use \Exception;
use Magento\Backend\App\Action;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Elogic\Vendor\Api\VendorRepositoryInterface;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Class Delete
 * @package Elogic\Vendor\Controller\Adminhtml\VendorsList
 */
class Delete extends Action
{
    /**
     * @var VendorRepositoryInterface
     */
    private $vendorRepository;

    /**
     * Delete constructor.
     * @param VendorRepositoryInterface $vendorRepository
     * @param Action\Context $context
     */
    public function __construct(
        VendorRepositoryInterface $vendorRepository,
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
     * @return Redirect|ResponseInterface|ResultInterface
     * @throws NoSuchEntityException
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
            } catch (Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
                return $resultRedirect->setPath('*/*/edit', ['id' => $id]);
            }
        } else {
            $this->messageManager->addErrorMessage(__('Vendor does not exist'));
        }
        return $resultRedirect->setPath('*/*/');
    }
}
