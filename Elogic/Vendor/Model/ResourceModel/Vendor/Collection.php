<?php
namespace Elogic\Vendor\Model\ResourceModel\Vendor;

use Elogic\Vendor\Model\ResourceModel\Vendor;
use Elogic\Vendor\Model\Vendor as VendorModel;
use \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * Class Collection
 * @package Elogic\Vendor\Model\ResourceModel\Vendor
 */
class Collection extends AbstractCollection
{
    protected $_idFieldName = 'entity_id';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            VendorModel::class,
            Vendor::class
        );
    }
}
