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
    private $collectionFactory;

    /**
     * Vendor constructor.
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(
        CollectionFactory $collectionFactory
    ) {
        $this->collectionFactory = $collectionFactory->create();
    }
    /**
     * Get all options
     * @return array
     */
    public function getAllOptions()
    {
        $items = $this->collectionFactory->getItems();
        if (!$this->_options) {
            $this->_options[] = ['label' => __(''), 'value' => null];
            foreach ($items as $item) {
                $this->_options[] = ['label' => __($item['name']), 'value' => $item['entity_id']];
            }
        }
        return $this->_options;
    }
}
