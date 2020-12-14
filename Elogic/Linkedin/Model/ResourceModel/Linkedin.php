<?php
namespace Elogic\Linkedin\Model\ResourceModel;

use \Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Magento\Framework\Model\ResourceModel\Db\Context;

/**
 * Class Vendor
 * @package Elogic\Linkedin\Model\ResourceModel
 */
class Linkedin extends AbstractDb
{
    public function __construct(
        Context $context
    ) {
        parent::__construct($context);
    }

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('elogic_linkedin_profile', 'customer_id');
    }
}
