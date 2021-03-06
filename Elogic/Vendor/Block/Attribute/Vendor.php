<?php
namespace Elogic\Vendor\Block\Attribute;

use Magento\Catalog\Model\Product;
use Magento\Framework\Registry;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

/**
 * Class Vendor
 * @package Elogic\Vendor\Block\Attribute
 */
class Vendor extends Template
{
    /**
     * @var Product
     */
    protected $_product = null;

    /**
     * Core registry
     *
     * @var Registry
     */
    protected $_coreRegistry = null;

    /**
     * @param Context $context
     * @param Registry $registry
     * @param array $data
     */
    public function __construct(
        Context $context,
        Registry $registry,
        array $data = []
    ) {
        $this->_coreRegistry = $registry;
        parent::__construct($context, $data);
    }

    /**
     * @return Product
     */
    public function getProduct()
    {
        if (!$this->_product) {
            $this->_product = $this->_coreRegistry->registry('product');
        }
        return $this->_product;
    }

    /**
     * @return string|null
     */
    public function getLogo()
    {
        return $this
            ->getProduct()
            ->getResource()
            ->getAttribute('product_vendor')
            ->getFrontend()
            ->getLogo($this->getProduct());
    }

    /**
     * @return string|null
     */
    public function getAttrLabel()
    {
        return $this->getProduct()
            ->getResource()
            ->getAttribute('product_vendor')
            ->getStoreLabel();
    }

    /**
     * @return string|null
     */
    public function getName()
    {
        return $this
            ->getProduct()
            ->getResource()
            ->getAttribute('product_vendor')
            ->getFrontend()
            ->getName($this->getProduct());
    }

    /**
     * @return string|null
     */
    public function getDescription()
    {
        return $this
            ->getProduct()
            ->getResource()
            ->getAttribute('product_vendor')
            ->getFrontend()
            ->getDescription($this->getProduct());
    }
}
