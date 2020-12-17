<?php
namespace Elogic\Vendor\Ui\Component\Listing\Column;

use Elogic\Vendor\Helper\ImageUrl;
use Magento\Catalog\Helper\Image;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Ui\Component\Listing\Columns\Column;

/**
 * Class Thumbnail
 * @package Elogic\Vendor\Ui\Component\Listing\Column
 */
class Thumbnail extends Column
{
    const ALT_FIELD = 'Logotype';

    /**
     * @var ImageUrl
     */
    protected $imageUrl;

    /**
     * @var StoreManagerInterface $storeManager
     */
    protected $storeManager;
    /**
     * @var Image
     */
    private $imageHelper;

    /**
     * @var UrlInterface
     */
    private $urlBuilder;

    /**
     * Thumbnail constructor.
     * @param ImageUrl $imageUrl
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param Image $imageHelper
     * @param UrlInterface $urlBuilder
     * @param StoreManagerInterface $storeManager
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ImageUrl $imageUrl,
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        Image $imageHelper,
        UrlInterface $urlBuilder,
        StoreManagerInterface $storeManager,
        array $components = [],
        array $data = []
    ) {
        $this->imageHelper = $imageHelper;
        $this->urlBuilder = $urlBuilder;
        $this->storeManager = $storeManager;
        parent::__construct($context, $uiComponentFactory, $components, $data);
        $this->imageUrl = $imageUrl;
    }

    /**
     * @param array $dataSource
     * @return array
     * @throws NoSuchEntityException
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            $fieldName = $this->getData('name');
            foreach ($dataSource['data']['items'] as & $item) {
                $url = null;
                if ($imageName = $item[$fieldName]) {
                    $imageData = $this->imageUrl->getImageUrlByName($imageName);
                    $url = $imageData['url'];
                }
                $item[$fieldName . '_src'] = $url;
                $item[$fieldName . '_alt'] = $this->getAlt($item) ?: '';
                $item[$fieldName . '_link'] = $this->urlBuilder->getUrl(
                    'vendors/vendorslist/edit',
                    ['id' => $item['entity_id']]
                );
                $item[$fieldName . '_orig_src'] = $url;
            }
        }

        return $dataSource;
    }

    /**
     * @param array $row
     *
     * @return null|string
     */
    protected function getAlt($row)
    {
        $altField = $this->getData('config/altField') ?: self::ALT_FIELD;
        return isset($row[$altField]) ? $row[$altField] : null;
    }
}
