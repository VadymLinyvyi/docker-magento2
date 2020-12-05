<?php
namespace Elogic\Vendor\Api;

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
     * @return \Elogic\Vendor\Api\Data\VendorInterface
     * @throws NoSuchEntityException
     */
    public function getById($id);

    /**
     * @param \Elogic\Vendor\Api\Data\VendorInterface $vendor
     * @return \Elogic\Vendor\Api\Data\VendorInterface
     */
    public function save(\Elogic\Vendor\Api\Data\VendorInterface $vendor);

    /**
     * @param \Elogic\Vendor\Api\Data\VendorInterface $vendor
     * @return void
     */
    public function delete(\Elogic\Vendor\Api\Data\VendorInterface $vendor);

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Elogic\Vendor\Api\Data\VendorSearchResultInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria);
}
