<?php
namespace Elogic\Linkedin\Model\ResourceModel\Linkedin;

use \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * Class Collection
 * @package Elogic\Linkedin\Model\ResourceModel\Linkedin
 */
class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'customer_id';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Elogic\Linkedin\Model\Linkedin', 'Elogic\Linkedin\Model\ResourceModel\Linkedin');
    }
}
