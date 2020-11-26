<?php

namespace Elogic\Blog\Controller\Index;


use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;


class Index extends \Magento\Framework\App\Action\Action
{
    /**
     * Booking action
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
        // 1. POST request : Get booking data
        $post = (array)$this->getRequest()->getPost();

        if (!empty($post)) {
            // Retrieve your form data
            $postData = [
                "author" => $post['author'],
                "title" => $post['title'],
                "desc" => $post['description'],
                "content" => $post['content'],
                "status" => 1,
                "enabled" => 1
            ];


            // Doing-something with...
            $article = $this->articleFactory->create();
            $article->setData($postData);
            $article->save();

            // Display the succes form validation message
            $this->messageManager->addSuccessMessage(__('Your article posted successfully!'));

            // Redirect to your form page (or anywhere you want...)
            $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
            $resultRedirect->setUrl('/blog');

            return $resultRedirect;
        }
        $this->_view->loadLayout();
        $this->_view->renderLayout();
    }
}
