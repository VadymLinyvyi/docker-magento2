<?php


namespace Elogic\Blog\Block;


class BlogArticles extends \Magento\Framework\View\Element\Template
{
    /**
     * Construct
     *
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param array $data
     */

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\App\RequestInterface $request,
        array $data = []
    )
    {
        parent::__construct($context, $data);
        $this->request = $request;
    }

    /**
     * Get form action URL for POST request
     *
     * @return string
     */

    public function getParam(){
        return '/blog/index/view';
    }
}
