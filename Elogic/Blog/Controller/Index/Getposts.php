<?php
namespace Elogic\Blog\Controller\Index;

use Magento\Framework\App\Action\Context;

class Getposts extends \Magento\Framework\App\Action\Action
{
    protected $_pageFactory;

    protected $_blogFactory;

    public function __construct(
        Context $context,
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \Elogic\Blog\Model\BlogFactory $blogFactory)
    {
        $this->_pageFactory = $pageFactory;
        $this->_blogFactory = $blogFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $blog = $this->_blogFactory->create();
        $collection = $blog->getCollection();
//        exit();
        return $this->$collection;
    }
}
