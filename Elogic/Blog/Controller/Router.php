<?php

namespace Elogic\Blog\Controller;

use Magento\Cms\Model\Page;
use Magento\Cms\Model\PageFactory;
use Magento\Framework\App\Action\Forward;
use Magento\Framework\App\Action\Redirect;
use Magento\Framework\App\ActionFactory;
use Magento\Framework\App\ActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\App\RouterInterface;
use Magento\Framework\App\State;
use Magento\Framework\DataObject;
use Magento\Framework\Event\ManagerInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\UrlInterface;
use Magento\Store\Model\StoreManagerInterface;
use Elogic\Blog\Model\ResourceModel\Blog\CollectionFactory;

/**
 * Class Router
 * @package Elogic\Blog\Controller
 */
class Router implements RouterInterface
{
    /**
     * @var ActionFactory
     */
    protected $actionFactory;

    /**
     * Event manager
     *
     * @var ManagerInterface
     */
    protected $eventManager;

    /**
     * Store manager
     *
     * @var StoreManagerInterface
     */
    protected $storeManager;

    /**
     * Page factory
     *
     * @var PageFactory
     */
    protected $pageFactory;

    /**
     * Config primary
     *
     * @var State
     */
    protected $appState;

    /**
     * Url
     *
     * @var UrlInterface
     */
    protected $url;

    /**
     * Response
     *
     * @var ResponseInterface
     */
    protected $response;
    /**
     * @var CollectionFactory
     */
    private $collection;

    /**
     * @param ActionFactory $actionFactory
     * @param ManagerInterface $eventManager
     * @param UrlInterface $url
     * @param PageFactory $pageFactory
     * @param StoreManagerInterface $storeManager
     * @param ResponseInterface $response
     * @param CollectionFactory $collection
     */
    public function __construct(
        ActionFactory $actionFactory,
        ManagerInterface $eventManager,
        UrlInterface $url,
        PageFactory $pageFactory,
        StoreManagerInterface $storeManager,
        ResponseInterface $response,
        CollectionFactory $collection
    ) {
        $this->actionFactory = $actionFactory;
        $this->eventManager = $eventManager;
        $this->url = $url;
        $this->pageFactory = $pageFactory;
        $this->storeManager = $storeManager;
        $this->response = $response;
        $this->collection = $collection->create();
    }

    /**
     * @param RequestInterface $request
     * @return ActionInterface|null
     * @throws NoSuchEntityException
     */
    public function match(RequestInterface $request)
    {
        $articles = $this->collection->getItems();
        $identifier = trim($request->getPathInfo(), '/');
        $parts = explode('/', $identifier);
        foreach ($articles as $article) {
            if ($article['url'] == $parts[1]) {
                $request->setModuleName('blog')
                    ->setControllerName('article')
                    ->setActionName('view')
                    ->setParam('id', $article['entity_id']);
                return $this->actionFactory->create(Forward::class);
            }
        }
        return null;
    }
}
