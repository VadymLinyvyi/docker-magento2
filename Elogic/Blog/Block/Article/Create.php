<?php
namespace Elogic\Blog\Block\Article;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

/**
 * Class Blog
 * @package Elogic\Blog\Block
 */
class Create extends Template
{
    /**
     * Create constructor.
     * @param Context $context
     * @param array $data
     */
    public function __construct(
        Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
    }

    /**
     * Get form action URL for POST request
     *
     * @return string
     */

    public function getFormAction()
    {
        return $this->getUrl('/*/*/newarticle/');
    }
}
