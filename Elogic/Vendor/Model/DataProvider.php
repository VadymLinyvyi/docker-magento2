<?php
namespace Elogic\Vendor\Model;

use Elogic\Vendor\Model\ResourceModel\Vendor\CollectionFactory;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\UrlInterface;
use Magento\Ui\DataProvider\AbstractDataProvider;
use Magento\Store\Model\StoreManagerInterface;

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
     * @var StoreManagerInterface
     */
    protected $store;

    /**
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $vendorCollectionFactory
     * @param StoreManagerInterface $store
     * @param array $meta
     * @param array $data
     */
    public function __construct(
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
                $firstName = substr($imageName, 0, 1);
                $secondName = substr($imageName, 1, 1);
                unset($itemData['logo']);
                $itemData['logo'][0] = [
                    'name' => $imageName,
                    'file' => $imageName,
                    'url' => "{$this->store->getStore()
                    ->getBaseUrl(UrlInterface::URL_TYPE_MEDIA)}logo/image/{$firstName}/{$secondName}/{$imageName}"
                ];
            } else {
                $itemData['logo'] = null;
            }
            $this->_loadedData[$vendor->getEntityId()] = $itemData;
        }
        return $this->_loadedData;
    }
}
