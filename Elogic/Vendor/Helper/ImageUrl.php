<?php
namespace Elogic\Vendor\Helper;

use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\UrlInterface;
use Magento\Store\Model\StoreManagerInterface;

/**
 * Class ImageUrl
 * @package Elogic\Vendor\Helper
 */
class ImageUrl
{
    /**
     * @var StoreManagerInterface
     */
    protected $store;

    /**
     * ImageUrl constructor.
     * @param StoreManagerInterface $store
     */
    public function __construct(
        StoreManagerInterface $store
    ) {
        $this->store = $store;
    }

    /**
     * @param $imageName
     * @return array
     * @throws NoSuchEntityException
     */
    public function getImageUrlByName($imageName)
    {
        return $data = [
            'name' => $imageName,
            'file' => $imageName,
            'url' => "{$this->store->getStore()
                    ->getBaseUrl(UrlInterface::URL_TYPE_MEDIA)}logo/image/{$imageName}"
            ];
    }
}
