<?php


namespace Elogic\Blog\Model\ResourceModel\Blog;


class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init('Elogic\Blog\Model\Blog', 'Elogic\Blog\Model\ResourceModel\Blog');
    }
}
