<?php

namespace Elogic\Vendor\Plugin;

use Magento\Catalog\Block\Product\ListProduct;
use Magento\Framework\Exception\LocalizedException;

/**
 * Class CatalogViewProductAttributeUpdater
 * @package Elogic\Vendor\Plugin
 */
class CatalogViewProductAttributeUpdaterPlugin
{
    /**
     * @param ListProduct $listProduct
     * @param $result
     * @param $_product
     * @return mixed|string
     * @throws LocalizedException
     */
    public function afterGetProductDetailsHtml(ListProduct $listProduct, $result, $_product)
    {
        if (isset($_product)) {
            $attrLabel = $_product->getResource()->getAttribute('product_vendor')->getStoreLabel();
            $vendorName = $_product->getResource()->getAttribute('product_vendor')->getFrontend()->getName($_product);
            $vendorDescription = $_product
                ->getResource()->getAttribute('product_vendor')->getFrontend()->getDescription($_product);
        }
        if ($vendorName) {
            $result = $result . $listProduct->getLayout()
                    ->createBlock('Magento\Framework\View\Element\Template')
                    ->setData('attrLabel', $attrLabel)
                    ->setData('vendorName', $vendorName)
                    ->setData('vendorDescription', $vendorDescription)
                    ->setTemplate('Elogic_Vendor::vendor_catalog_view.phtml')
                    ->toHtml();
        }
        return $result;
    }
}
