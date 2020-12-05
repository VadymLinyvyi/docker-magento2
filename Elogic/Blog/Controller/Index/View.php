<?php
namespace Elogic\Blog\Controller\Index;

use Elogic\Blog\Model\ResourceModel\Blog\Collection;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;


class View extends \Magento\Framework\App\Action\Action
{
    /**
     *
     * @return string
     */

    /**
     * @var \Elogic\Blog\Model\BlogFactory
     */
    private $articleFactory;

    public function __construct(
        Context $context,
        \Elogic\Blog\Model\BlogFactory $blogFactory
    )
    {
        $this->articleFactory = $blogFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $post = $this->getRequest()->getParam("id","0");
        $article = $this->articleFactory->create();
        $article->load();
        $article->getData();


    }
}
