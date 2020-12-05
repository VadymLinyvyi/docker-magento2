<?php

namespace Elogic\Vendor\Controller\Adminhtml\VendorsList;

use Elogic\Vendor\Api\VendorRepositoryInterfaceFactory;
use Exception;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Ui\Component\MassAction\Filter;
use Elogic\Vendor\Model\ResourceModel\Vendor\CollectionFactory;

/**
 * Class MassDelete
 * @package Elogic\Vendor\Controller\Adminhtml\VendorsList
 */
class MassDelete extends \Magento\Backend\App\Action
{
    /**
     * @var Filter
     */
    protected $filter;

    /**
     * @var CollectionFactory
     */

    protected $collectionFactory;

    /**
     * @var VendorRepositoryInterfaceFactory
     */
    protected $vendorRepository;

    /**
     * MassDelete constructor.
     * @param Context $context
     * @param Filter $filter
     * @param CollectionFactory $collectionFactory
     * @param VendorRepositoryInterfaceFactory $vendorRepository
     */
    public function __construct(
        Context $context,
        Filter $filter,
        CollectionFactory $collectionFactory,
        VendorRepositoryInterfaceFactory $vendorRepository
    ) {
        $this->filter = $filter;
        $this->vendorRepository = $vendorRepository;
        $this->collectionFactory = $collectionFactory;
        parent::__construct($context);
    }

    /**
     * @return Redirect|ResponseInterface|ResultInterface
     * @throws LocalizedException
     */
    public function execute()
    {
        $collection = $this->filter->getCollection($this->collectionFactory->create());
        $collectionSize = $collection->getSize();
        /** @var Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        try {
            foreach ($collection as $item) {
//                $model = $this->model;
//                $model->load($item->getId());
//                $model->delete();
                $vendor = $this->vendorRepository->getById($item->getId());
                $this->vendorRepository->delete($vendor);
            }
        } catch (Exception $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
            return $resultRedirect->setPath('*/*/');
        }

        $this->messageManager->addSuccessMessage(__('A total of %1 record(s) have been deleted.', $collectionSize));

        /** @var Redirect $resultRedirect */
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $resultRedirect->setPath('*/*/');
    }
}
