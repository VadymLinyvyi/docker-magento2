<?php

namespace Elogic\Anbis\Observer;

use Magento\Framework\App\RequestInterface;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

/**
 * Class QuoteProductAddAfter
 * @package Elogic\Anbis\Observer
 */
class QuoteProductAddAfter implements ObserverInterface
{
    /**
     * @var RequestInterface
     */
    private $request;

    /**
     * @param RequestInterface $request
     */
    public function __construct(
        RequestInterface $request
    ) {
        $this->request = $request;
    }


    /**
     * {@inheritdoc}
     */
    public function execute(Observer $observer)
    {
        $event = $observer->getEvent();
        $items = $event->getItems();
        $requestData = $this->request->getParams();
        foreach ($items as $item) {
            if ($item->getData('product_id') == $requestData['product']) {
                $item->setData('name1', $requestData['name1']);
                $item->setData('name2', $requestData['name2']);
            }
        }
    }
}
