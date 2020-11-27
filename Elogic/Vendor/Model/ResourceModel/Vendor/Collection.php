<?php


namespace Elogic\Vendor\Model\ResourceModel\Vendor;


class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init('Elogic\Vendor\Model\Vendor', 'Elogic\Vendor\Model\ResourceModel\Vendor');
    }
}
