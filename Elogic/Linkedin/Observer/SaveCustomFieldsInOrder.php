<?php

namespace Elogic\Linkedin\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

/**
 * Class SaveCustomFieldsInOrder
 * @package Elogic\Linkedin\Observer
 */
class SaveCustomFieldsInOrder implements ObserverInterface
{

    /**
     * @inheritDoc
     */
    public function execute(Observer $observer)
    {
        $order = $observer->getEvent()->getOrder();
        $quote = $observer->getEvent()->getQuote();
        $order->setData('linkedin_profile', $quote->getLinkedinProfile());
        return $this;
    }
}
