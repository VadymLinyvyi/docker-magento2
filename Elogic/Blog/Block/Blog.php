<?php


namespace Elogic\Blog\Block;

class Blog extends \Magento\Framework\View\Element\Template
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
     * Get form action URL for POST booking request
     *
     * @return string
     */

    public function getFormAction(){
        return '/blog';
    }
}
