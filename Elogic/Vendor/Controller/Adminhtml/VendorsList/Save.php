<?php
namespace Elogic\Vendor\Controller\Adminhtml\VendorsList;

use Elogic\Vendor\Api\VendorRepositoryInterface;
use Elogic\Vendor\Api\Data\VendorInterface;
use Exception;
use Magento\Backend\App\Action;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use RuntimeException;

/**
 * Class Save
 * @package Elogic\Vendor\Controller\Adminhtml\VendorsList
 */
class Save extends Action
{
    /**
     * @var VendorRepositoryInterface
     */
    private $vendorRepository;

    /**
     * @var VendorInterface;
     */
    private $vendor;

    /**
     * @param Action\Context $context
     * @param VendorRepositoryInterface $vendorRepository
     * @param VendorInterface $vendor
     */
    public function __construct(
        Action\Context $context,
        VendorRepositoryInterface $vendorRepository,
        VendorInterface $vendor
    ) {
        parent::__construct($context);
        $this->vendorRepository = $vendorRepository;
        $this->vendor = $vendor;
    }

    /**
     * {@inheritdoc}
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Elogic_Vendor::vendor_save');
    }

    /**
     * Save action
     *
     * @return ResultInterface
     * @throws NoSuchEntityException
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        /** @var Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {
            (int) $id = $data['entity_id'];
            if ($id) {
                $vendor = $this->vendorRepository->getById($id);
                $vendor->setName($data['vendor_name']);
                $vendor->setDescription($data['desc']);
                if (isset($data['logo'])) {
                    $vendor->setImageUrl($data['logo'][0]['name']);
                }
            } else {
                unset($data['entity_id']);
                $vendor = $this->vendor->createEntity($data);
            }

            $this->_eventManager->dispatch(
                'elogic_vendor_list_prepare_save',
                ['vendor' => $vendor, 'request' => $this->getRequest()]
            );

            try {
                $this->vendorRepository->save($vendor);
                $this->messageManager->addSuccessMessage(__('Vendor saved'));
                $this->_getSession()->setFormData(false);
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath(
                        '*/*/edit',
                        ['entity_id' => $vendor->getEntityId(), '_current' => true]
                    );
                }
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (RuntimeException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the vendor'));
            }

            $this->_getSession()->setFormData($data);
            return $resultRedirect->setPath('*/*/edit', ['entity_id' => $this->getRequest()->getParam('id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}
