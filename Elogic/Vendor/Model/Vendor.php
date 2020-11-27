<?php


namespace Elogic\Vendor\Model;


class Vendor extends \Magento\Framework\Model\AbstractModel
{

    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init('Elogic\Vendor\Model\ResourceModel\Vendor');
    }
}
