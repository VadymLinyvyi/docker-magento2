<?php
namespace Elogic\Vendor\Model;

use Elogic\Vendor\Model\ResourceModel\Vendor\CollectionFactory;
use Magento\Ui\DataProvider\AbstractDataProvider;

/**
 * Class DataProvider
 * @package Elogic\Vendor\Model
 */
class DataProvider extends AbstractDataProvider
{
    /**
    @var array
     */
    protected $loadedData;

    /**
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $vendorCollectionFactory
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $vendorCollectionFactory,
        array $meta = [],
        array $data = []
    )
    {
        $this->collection = $vendorCollectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
        $result = [];
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }

        $this->loadedData = $this->collection->getItems();
        foreach ($this->loadedData as $item){
            $result = $item->getData();
            unset($result['id_field_name']);
            unset($result['created_at']);
            unset($result['updated_at']);
            unset($result['orig_data']);
        }
        /** @var array $result */
        return $result;
    }
}
