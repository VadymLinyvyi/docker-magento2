<?php

namespace Elogic\Linkedin\Model\Attribute\Backend;

use Magento\Eav\Model\Entity\Attribute\Backend\AbstractBackend;
use Elogic\Linkedin\Model\Attribute\Helper\AttributeStatus;
use Magento\Framework\DataObject;
use Magento\Framework\Exception\LocalizedException;

/**
 * Class Linkedin
 * @package Elogic\Linkedin\Model\Attribute\Backend
 */
class Linkedin extends AbstractBackend
{
    const IS_REQUIRED = 2;

    /**
     * @var AttributeStatus
     */
    protected $attributeStatus;

    /**
     * Linkedin constructor.
     * @param AttributeStatus $attributeStatus
     */
    public function __construct(AttributeStatus $attributeStatus)
    {
        $this->attributeStatus = $attributeStatus;
    }

    /**
     * @param DataObject $object
     * @return bool
     * @throws LocalizedException
     */
    public function validate($object)
    {
        $value = $object->getData($this->getAttribute()->getAttributeCode());
        if (($this->attributeStatus->getLinkedinAttributeStatus() == self::IS_REQUIRED) && (!$value)) {
            throw new LocalizedException(
                __('Linkedin url can not be empty')
            );
        }
        if (strlen($value) > 250) {
            throw new LocalizedException(
                __('Linkedin url can not be longer than 250 characters')
            );
        }
        if (!filter_var($value, FILTER_VALIDATE_URL)) {
            throw new LocalizedException(
                __('Linkedin url is not valid')
            );
        }
        return true;
    }
}
