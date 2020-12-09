<?php

namespace Elogic\Blog\Controller\Article;

use Elogic\Blog\Model\BlogFactory;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;

/**
 * Class NewArticle
 * @package Elogic\Blog\Controller\Article
 */
class NewArticle extends Action
{
    /**
     * @var BlogFactory
     */
    private $articleFactory;

    /**
     * NewArticle constructor.
     * @param Context $context
     * @param BlogFactory $blogFactory
     */
    public function __construct(
        Context $context,
        BlogFactory $blogFactory
    ) {
        $this->articleFactory = $blogFactory;
        parent::__construct($context);
    }

    /**
     * @param $url
     * @return mixed
     */
    private function sluggify($url)
    {
        # Prep string with some basic normalization
        $url = strtolower($url);
        $url = strip_tags($url);
        $url = stripslashes($url);
        $url = html_entity_decode($url);

        # Remove quotes (can't, etc.)
        $url = str_replace('\'', '', $url);

        # Replace non-alpha numeric with hyphens
        $match = '/[^a-z0-9]+/';
        $replace = '-';
        $url = preg_replace($match, $replace, $url);

        $url = trim($url, '-');

        return $url;
    }

    /**
     * @return ResponseInterface|ResultInterface
     */
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
                "url" => $this->sluggify($post['title']),
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
