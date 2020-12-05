<?php
namespace Elogic\Vendor\Api\Data;

use Magento\Framework\Api\ExtensibleDataInterface;

/**
 * Interface VendorInterface
 * @package Elogic\Vendor\Api\Data
 */
interface VendorInterface extends ExtensibleDataInterface
{
    const VENDOR_ID = 'entity_id';              // define the id field name
    const NAME = 'vendor_name';                 // define the name field name
    const DESCRIPTION = 'desc';                 // define the description field name
    const IMAGE_URL = 'logo';                   // define the logotype field name

    /**
     * @return int
     */
    public function getEntityId();

    /**
     * @param int $id
     * @return void
     */
    public function setEntityId($id);

    /**
     * @return string
     */
    public function getName();

    /**
     * @param string $name
     * @return void
     */
    public function setName($name);

    /**
     * @return string
     */
    public function getDescription();

    /**
     * @param string $name
     * @return void
     */
    public function setDescription($name);

    /**
     * @return string
     */
    public function getImageUrl();

    /**
     * @param string $url
     * @return void
     */
    public function setImageUrl($url);

    /**
     * @param array $data
     * @return mixed
     */
    public function createEntity(array $data);
}
