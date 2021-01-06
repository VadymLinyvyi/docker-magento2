<?php

namespace Elogic\Anbis\Plugin;

use Magento\Quote\Model\Quote\Item\AbstractItem;
use Magento\Quote\Model\Quote\Item\ToOrderItem;

/**
 * Class AnbisToOrderItemPlugin
 * @package Elogic\Anbis\Plugin
 */
class AnbisToOrderItemPlugin
{
    public function afterConvert(
        ToOrderItem $subject,
        $orderItem,
        AbstractItem $item
    ) {
        $orderItem->setData('name1', $item->getData('name1'));
        $orderItem->setData('name2', $item->getData('name2'));
        return $orderItem;
    }
}
