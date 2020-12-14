<?php
namespace Elogic\Linkedin\Model;

use \Magento\Framework\Model\AbstractExtensibleModel;

/**
 * Class Vendor
 * @package Elogic\Linkedin\Model
 */
class Linkedin extends AbstractExtensibleModel
{
    const CUSTOMER_ID = 'customer_id';
    const URL = 'linkedin_url';
    const STATUS = 'status';

    /**
     * Prefix of model events names
     *
     * @var string
     */
    protected $_eventPrefix = 'elogic_linkedin_profile';  // parent value is 'core_abstract'

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
    protected $_idFieldName = self::CUSTOMER_ID;  // parent value is 'id'

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(ResourceModel\Linkedin::class);
    }

    /**
     * @return int|mixed|null
     */
    public function getEntityId()
    {
        return $this->_getData(self::CUSTOMER_ID);
    }

    /**
     * @param string $id
     */
    public function setEntityId($id)
    {
        $this->setData(self::CUSTOMER_ID, $id);
    }

    /**
     * @return mixed|string|null
     */
    public function getURL()
    {
        return $this->_getData(self::URL);
    }

    /**
     * @param string $url
     */
    public function setURL($url)
    {
        $this->setData(self::URL, $url);
    }

    /**
     * @return int
     */
    public function getStatus()
    {
        return $this->_getData(self::STATUS);
    }

    /**
     * @param int $status
     */
    public function setStatus($status)
    {
        $this->setData(self::STATUS, $status);
    }

    /**
     * @param array $data
     * @return Linkedin
     */
    public function createEntity(array $data)
    {
        return $this->setData($data);
    }
}
