<?php
namespace Elogic\Vendor\Model\Attribute\Frontend;

use \Elogic\Vendor\Api\Data\VendorInterface;
use \Elogic\Vendor\Api\VendorRepositoryInterface;
use Magento\Eav\Model\Entity\Attribute\Frontend\AbstractFrontend;
use Magento\Eav\Model\Entity\Attribute\Source\BooleanFactory;
use Magento\Framework\App\CacheInterface;
use Magento\Framework\DataObject;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Serialize\Serializer\Json as Serializer;
use Magento\Framework\UrlInterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Tests\NamingConvention\true\string;

/**
 * Class Vendor
 * @package Elogic\Vendor\Model\Attribute\Frontend
 */
class Vendor extends AbstractFrontend
{
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
    }

    /**
     * @param DataObject $object
     * @return array
     * @throws NoSuchEntityException
     */
    public function getLogo(DataObject $object)
    {
        $id = $object->getData($this->getAttribute()->getAttributeCode());
        $this->vendor = $this->vendorRepository->getById($id);
        $url = $this->vendor->getData()['logo'];
        if ($url) {
            $imageName = $url;
            $firstName = substr($imageName, 0, 1);
            $secondName = substr($imageName, 1, 1);
            $url = $this->storeManager->getStore()->getBaseUrl(
                UrlInterface::URL_TYPE_MEDIA
            ).'logo/image/'.$firstName.'/'.$secondName.'/'.$imageName;
        } else {
            $url = '';
        }
        $alt = $this->vendor->getName();
        return [
            'url'=>$url,
            'alt'=>$alt
        ];
    }

    /**
     * @param DataObject $object
     * @return string
     * @throws NoSuchEntityException
     */
    public function getName(DataObject $object)
    {
        $id = $object->getData($this->getAttribute()->getAttributeCode());
        $this->vendor = $this->vendorRepository->getById($id);
        $vendorName = $this->vendor->getData()['vendor_name'];
        return $vendorName;
    }

    /**
     * @param DataObject $object
     * @return string
     * @throws NoSuchEntityException
     */
    public function getDescription(DataObject $object)
    {
        $id = $object->getData($this->getAttribute()->getAttributeCode());
        $this->vendor = $this->vendorRepository->getById($id);
        $desc =  $vendorName = $this->vendor->getData()['desc'];
        return $desc;
    }
}
