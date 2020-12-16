<?php
namespace Elogic\Vendor\Plugin;

use Magento\Catalog\Block\Product\ListProduct;

class CatalogViewProductAttributeUpdater
{
    public function afterGetProductDetailsHtml(ListProduct $listProduct, $result, $_product)
    {
        if (isset($_product)) {
            $attrLabel = $_product->getResource()->getAttribute('product_vendor')->getStoreLabel();
            $vendorName = $_product->getResource()->getAttribute('product_vendor')->getFrontend()->getName($_product);
            $vendorDescription = $_product->getResource()->getAttribute('product_vendor')->getFrontend()->getDescription($_product);
        }
        if ($vendorName) {
            $result = $result
                . '<div class="vendor-info-catalog-view">'
                . '<span class="vendor-info label">' . $attrLabel . '</span>'
                . '<span class="vendor-info name">' . $vendorName . '</span>'
                . '<span class="vendor-info desc">' . $vendorDescription . '</span>';
        }
        return $result;
    }
}
