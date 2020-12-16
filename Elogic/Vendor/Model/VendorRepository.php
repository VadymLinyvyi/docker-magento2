<?php
namespace Elogic\Vendor\Model;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\AlreadyExistsException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Api\SortOrder;
use Elogic\Vendor\Api\Data\VendorInterface;
use Elogic\Vendor\Api\Data\VendorSearchResultInterface;
use Elogic\Vendor\Api\Data\VendorSearchResultInterfaceFactory;
use Elogic\Vendor\Api\VendorRepositoryInterface;
use Elogic\Vendor\Model\ResourceModel\Vendor\CollectionFactory as VendorCollectionFactory;
use Elogic\Vendor\Model\ResourceModel\Vendor\Collection;

/**
 * Class VendorRepository
 * @package Elogic\Vendor\Model
 */
class VendorRepository implements VendorRepositoryInterface
{
    /**
     * @var VendorFactory
     */
    private $vendorFactory;

    /**
     * @var VendorCollectionFactory
     */
    private $vendorCollectionFactory;

    /**
     * @var VendorSearchResultInterfaceFactory
     */
    private $searchResultFactory;

    /**
     * VendorRepository constructor.
     * @param VendorFactory $vendorFactory
     * @param VendorCollectionFactory $vendorCollectionFactory
     * @param VendorSearchResultInterfaceFactory $vendorSearchResultInterfaceFactory
     */
    public function __construct(
        VendorFactory $vendorFactory,
        VendorCollectionFactory $vendorCollectionFactory,
        VendorSearchResultInterfaceFactory $vendorSearchResultInterfaceFactory
    ) {
        $this->vendorFactory = $vendorFactory;
        $this->vendorCollectionFactory = $vendorCollectionFactory;
        $this->searchResultFactory = $vendorSearchResultInterfaceFactory;
    }

    /**
     * @param int $id
     * @return VendorInterface|Vendor
     * @throws NoSuchEntityException
     */
    public function getById($id)
    {
        $vendor = $this->vendorFactory->create();
        $vendor->getResource()->load($vendor, $id);
        if (!$vendor->getId()) {
            throw new NoSuchEntityException(__('Unable to find vendor with ID "%1"', $id));
        }
        return $vendor;
    }

    /**
     * @param VendorInterface $vendor
     * @return VendorInterface
     * @throws AlreadyExistsException
     */
    public function save(VendorInterface $vendor)
    {
        $vendor->getResource()->save($vendor);
        return $vendor;
    }

    /**
     * @param VendorInterface $vendor
     */
    public function delete(VendorInterface $vendor)
    {
        $vendor->getResource()->delete($vendor);
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return VendorSearchResultInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        $collection = $this->vendorCollectionFactory->create();
        $this->addFiltersToCollection($searchCriteria, $collection);
        $this->addSortOrdersToCollection($searchCriteria, $collection);
        $this->addPagingToCollection($searchCriteria, $collection);
        $collection->load();
        return $this->buildSearchResult($searchCriteria, $collection);
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @param Collection $collection
     */
    private function addFiltersToCollection(SearchCriteriaInterface $searchCriteria, Collection $collection)
    {
        foreach ($searchCriteria->getFilterGroups() as $filterGroup) {
            $fields = $conditions = [];
            foreach ($filterGroup->getFilters() as $filter) {
                $fields[] = $filter->getField();
                $conditions[] = [$filter->getConditionType() => $filter->getValue()];
            }
            $collection->addFieldToFilter($fields, $conditions);
        }
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @param Collection $collection
     */
    private function addSortOrdersToCollection(SearchCriteriaInterface $searchCriteria, Collection $collection)
    {
        foreach ((array) $searchCriteria->getSortOrders() as $sortOrder) {
            $direction = $sortOrder->getDirection() == SortOrder::SORT_ASC ? 'asc' : 'desc';
            $collection->addOrder($sortOrder->getField(), $direction);
        }
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @param Collection $collection
     */
    private function addPagingToCollection(SearchCriteriaInterface $searchCriteria, Collection $collection)
    {
        $collection->setPageSize($searchCriteria->getPageSize());
        $collection->setCurPage($searchCriteria->getCurrentPage());
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @param Collection $collection
     * @return VendorSearchResultInterface
     */
    private function buildSearchResult(SearchCriteriaInterface $searchCriteria, Collection $collection)
    {
        $searchResults = $this->searchResultFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }
}
