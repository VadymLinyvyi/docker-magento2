<?php
namespace Elogic\Vendor\Model\Attribute\Frontend;

use Elogic\Vendor\Api\Data\VendorInterface;
use Elogic\Vendor\Api\VendorRepositoryInterface;
use Magento\Eav\Model\Entity\Attribute\Frontend\AbstractFrontend;
use Magento\Eav\Model\Entity\Attribute\Source\BooleanFactory;
use Magento\Framework\App\CacheInterface;
use Magento\Framework\DataObject;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Serialize\Serializer\Json as Serializer;
use Magento\Store\Model\StoreManagerInterface;
use Elogic\Vendor\Helper\ImageUrl;

/**
 * Class Vendor
 * @package Elogic\Vendor\Model\Attribute\Frontend
 */
class Vendor extends AbstractFrontend
{
    /**
     * @var ImageUrl
     */
    protected $imageUrl;

    /**
     * @var VendorRepositoryInterface
     */
    protected $vendorRepository;

    /**
     * @var VendorInterface
     */
    protected $vendor;

    /**
     * @var StoreManagerInterface $storeManager
     */
    protected $storeManager;

    /**
     * Vendor constructor.
     * @param ImageUrl $imageUrl
     * @param VendorRepositoryInterface $vendorRepository
     * @param VendorInterface $vendor
     * @param StoreManagerInterface $storeManager
     * @param BooleanFactory $attrBooleanFactory
     * @param CacheInterface|null $cache
     * @param null $storeResolver
     * @param array|null $cacheTags
     * @param Serializer|null $serializer
     */
    public function __construct(
        ImageUrl $imageUrl,
        VendorRepositoryInterface $vendorRepository,
        VendorInterface $vendor,
        StoreManagerInterface $storeManager,
        BooleanFactory $attrBooleanFactory,
        CacheInterface $cache = null,
        $storeResolver = null,
        array $cacheTags = null,
        Serializer $serializer = null
    ) {
        $this->vendorRepository = $vendorRepository;
        $this->vendor = $vendor;
        $this->storeManager = $storeManager;
        parent::__construct($attrBooleanFactory, $cache, $storeResolver, $cacheTags, $storeManager, $serializer);
        $this->imageUrl = $imageUrl;
    }

    /**
     * @param DataObject $object
     * @return array|null
     * @throws NoSuchEntityException
     */
    public function getLogo(DataObject $object)
    {
        $id = $object->getData($this->getAttribute()->getAttributeCode());
        $image = null;
        if ($id) {
            $this->vendor = $this->vendorRepository->getById($id);
            $url = $this->vendor->getData('logo');
            if ($url) {
                $imageName = $url;
                $imageData = $this->imageUrl->getImageUrlByName($imageName);
                $url = $imageData['url'];
            } else {
                $url = '';
            }
            $alt = $this->vendor->getName();
            $image = [
                'url'=>$url,
                'alt'=>$alt
            ];
        }
        return $image;
    }

    /**
     * @param DataObject $object
     * @return mixed|null
     * @throws NoSuchEntityException
     */
    public function getName(DataObject $object)
    {
        $id = $object->getData($this->getAttribute()->getAttributeCode());
        $name = null;
        if ($id) {
            $this->vendor = $this->vendorRepository->getById($id);
            $name = $this->vendor->getData('name');
        }
        return $name;
    }

    /**
     * @param DataObject $object
     * @return mixed|null
     * @throws NoSuchEntityException
     */
    public function getDescription(DataObject $object)
    {
        $id = $object->getData($this->getAttribute()->getAttributeCode());
        $description = null;
        if ($id) {
            $this->vendor = $this->vendorRepository->getById($id);
            $description = $vendorName = $this->vendor->getData('description');
        }
        return $description;
    }
}
