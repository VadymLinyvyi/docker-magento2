<?php
namespace Elogic\Vendor\Model\ResourceModel;

use \Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class Vendor
 * @package Elogic\Vendor\Model\ResourceModel
 */
class Vendor extends AbstractDb
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('elogic_vendor_list', 'entity_id');
    }
}
