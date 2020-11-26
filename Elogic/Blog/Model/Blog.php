<?php


namespace Elogic\Blog\Model;


class Blog extends \Magento\Framework\Model\AbstractModel
{

    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init('Elogic\Blog\Model\ResourceModel\Blog');
    }
}
