<?php
namespace Elogic\Blog\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action
{
    /**
     * @var PageFactory $resultPageFactory
     */
    protected $resultPageFactory;

    /**
     *
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    public function tempForPlugin($a = 2, $b = 3, $c = 10)
    {
        $a++;
        $b--;
        $c*=$a+$b;
        $this->_eventManager->dispatch('some_flag', [$a, $b, $c]);
        return $c;
    }

    public function execute()
    {
        $temp = $this->tempForPlugin(10,25,88);
        return $this->resultPageFactory->create();
    }
}
