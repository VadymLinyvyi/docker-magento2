<?php

namespace Elogic\Linkedin\Model\Attribute\Backend;

use Elogic\Linkedin\Model\Config\Source\NoOptionalRequired;
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
        $identifier = trim($value, '/');
        $parts = explode('/', $identifier);
        if (isset($parts[0]) && ($parts[0] != 'http:' || $parts[0] != 'https:')) {
            $value = 'http://' . $value;
        }
        if (($this->attributeStatus->getLinkedinAttributeStatus() == NoOptionalRequired::IS_REQUIRED) && (!$value)) {
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
