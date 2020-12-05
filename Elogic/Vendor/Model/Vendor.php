<?php
namespace Elogic\Vendor\Model;

use \Magento\Framework\Model\AbstractExtensibleModel;
use Elogic\Vendor\Api\Data\VendorExtensionInterface;
use Elogic\Vendor\Api\Data\VendorInterface;

/**
 * Class Vendor
 * @package Elogic\Vendor\Model
 */
class Vendor extends AbstractExtensibleModel implements VendorInterface
{

    /**
     * Prefix of model events names
     *
     * @var string
     */
    protected $_eventPrefix = 'elogic_vendor';  // parent value is 'core_abstract'

    /**
     * Name of the event object
     *
     * @var string
     */
    protected $_eventObject = 'list';           // parent value is 'object'

    /**
     * Name of object id field
     *
     * @var string
     */
    protected $_idFieldName = self::VENDOR_ID;  // parent value is 'id'

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(ResourceModel\Vendor::class);
    }

    /**
     * @return int|mixed|null
     */
    public function getEntityId()
    {
        return $this->_getData(self::VENDOR_ID);
    }

    /**
     * @return mixed|string|null
     */
    public function getName()
    {
        return $this->_getData(self::NAME);
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->setData(self::NAME, $name);
    }

    /**
     * @return mixed|string|null
     */
    public function getDescription()
    {
        return $this->_getData(self::DESCRIPTION);
    }

    /**
     * @param string $desc
     */
    public function setDescription($desc)
    {
        $this->setData(self::DESCRIPTION, $desc);
    }

    /**
     * @return string|void
     */
    public function getImageUrl()
    {
        $this->_getData(self::IMAGE_URL);
    }

    /**
     * @param string $url
     */
    public function setImageUrl($url)
    {
        $this->setData(self::IMAGE_URL, $url);
    }

    /**
     * @param array $data
     * @return Vendor
     */
    public function createEntity(array $data)
    {
        return $this->setData($data);
    }
}
