<?php
namespace Elogic\Blog\Block\Article;

use Elogic\Blog\Model\ResourceModel\Blog\CollectionFactory;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use function PHPUnit\Framework\returnArgument;

/**
 * Class NewArticle
 * @package Elogic\Blog\Controller\Article
 */
class View extends Template
{
    /**
     * @var CollectionFactory $collection
     */
    private $collection;

    /**
     * View constructor.
     * @param Context $context
     * @param CollectionFactory $collection
     */
    public function __construct(
        Context $context,
        CollectionFactory $collection
    ) {

        parent::__construct($context);
        $this->collection = $collection->create();
    }

    /**
     * @return mixed
     */
    public function getArticle()
    {
        $articleId = $this->getRequest()->getParam('id');
        return $this->collection->getItemById(1)->getData();
    }
}
