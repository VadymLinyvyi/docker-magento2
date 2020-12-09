<?php
namespace Elogic\Blog\Block;

use Elogic\Blog\Model\ResourceModel\Blog\CollectionFactory;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

/**
 * Class ArticleListing
 * @package Elogic\Blog\Block
 */
class ArticleListing extends Template
{
    /**
     * @var CollectionFactory $collectionFactory
     */
    private $collectionFactory;

    public function __construct(
        Context $context,
        CollectionFactory $collection
    ) {
        parent::__construct($context);
        $this->collectionFactory = $collection->create();
    }

    /**
     * @return array
     */
    public function getItems()
    {
        $articles = $this->collectionFactory->getItems();
        $counter = 0;
        foreach ($articles as $article) {
            $result[$counter] = [
                'title' => $article->getData()['title'],
                'url' => $article->getData()['url']
            ];
            $counter++;
        }
        return $result;
    }
}
