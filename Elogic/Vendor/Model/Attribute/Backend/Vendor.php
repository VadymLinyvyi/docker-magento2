<?php
namespace Elogic\Vendor\Model\Attribute\Backend;

use Magento\Eav\Model\Entity\Attribute\Backend\AbstractBackend;
use Magento\Framework\DataObject;

/**
 * Class Vendor
 * @package Elogic\Vendor\Model\Attribute\Backend
 */
class Vendor extends AbstractBackend
{
    /**
     * @param DataObject $object
     * @return bool
     */
    public function validate($object)
    {
        return true;  //at this step we don't need any validation
    }
}
