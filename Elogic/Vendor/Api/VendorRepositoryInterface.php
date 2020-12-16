<?php
namespace Elogic\Vendor\Api;

use Elogic\Vendor\Api\Data\VendorInterface;
use Elogic\Vendor\Api\Data\VendorSearchResultInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Class VendorRepositoryInterface
 * @package Elogic\Vendor\Api
 */
interface VendorRepositoryInterface
{
    /**
     * @param int $id
     * @return VendorInterface
     * @throws NoSuchEntityException
     */
    public function getById($id);

    /**
     * @param VendorInterface $vendor
     * @return VendorInterface
     */
    public function save(VendorInterface $vendor);

    /**
     * @param VendorInterface $vendor
     * @return void
     */
    public function delete(VendorInterface $vendor);

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return VendorSearchResultInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria);
}
