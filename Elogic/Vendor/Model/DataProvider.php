<?php
namespace Elogic\Vendor\Model;

use Elogic\Vendor\Model\ResourceModel\Vendor\CollectionFactory;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Ui\DataProvider\AbstractDataProvider;
use Magento\Store\Model\StoreManagerInterface;
use Elogic\Vendor\Helper\ImageUrl;

/**
 * Class DataProvider
 * @package Elogic\Vendor\Model
 */
class DataProvider extends AbstractDataProvider
{
    /**
     * @var ImageUrl
     */
    protected $imageUrl;

    /**
     * @var array
     */
    protected $loadedData;

    /**
     * @var StoreManagerInterface
     */
    protected $store;

    /**
     * DataProvider constructor.
     * @param ImageUrl $imageUrl
     * @param $name
     * @param $primaryFieldName
     * @param $requestFieldName
     * @param CollectionFactory $vendorCollectionFactory
     * @param StoreManagerInterface $store
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        ImageUrl $imageUrl,
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $vendorCollectionFactory,
        StoreManagerInterface $store,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $vendorCollectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->store = $store;
        $this->imageUrl = $imageUrl;
    }

    /**
     * Get data
     *
     * @return array
     * @throws NoSuchEntityException
     */
    public function getData()
    {
        if (isset($this->_loadedData)) {
            return $this->_loadedData;
        }
        $this->_loadedData = [];
        $items = $this->collection->getItems();
        foreach ($items as $vendor) {
            $itemData = $vendor->getData();
            if (isset($itemData['logo'])) {
                $imageName = $itemData['logo'];
                unset($itemData['logo']);
                $itemData['logo'][0] = $this->imageUrl->getImageUrlByName($imageName);
            } else {
                $itemData['logo'] = null;
            }
            $this->_loadedData[$vendor->getEntityId()] = $itemData;
        }
        return $this->_loadedData;
    }
}
