<?php
namespace Elogic\Vendor\Model\Attribute\Source;

use Elogic\Vendor\Model\ResourceModel\Vendor\CollectionFactory;
use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;

/**
 * Class Vendor
 * @package Elogic\Vendor\Model\Attribute\Source
 */
class Vendor extends AbstractSource
{
    /**
     * @var CollectionFactory
     */
    private $collection;

    /**
     * Vendor constructor.
     * @param CollectionFactory $collection
     */
    public function __construct(
        CollectionFactory $collection
    ) {
        $this->collection = $collection->create();
    }
    /**
     * Get all options
     * @return array
     */
    public function getAllOptions()
    {
        $items = $this->collection->getItems();
        if (!$this->_options) {
            $this->_options = [];
            foreach ($items as $item) {
                $this->_options[] = ['label' => __($item['vendor_name']), 'value' => $item['entity_id']];
            }
        }
        return $this->_options;
    }
}
