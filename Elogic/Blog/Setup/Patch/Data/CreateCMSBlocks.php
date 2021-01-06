<?php

namespace Elogic\Blog\Setup\Patch\Data;

use Magento\Cms\Model\BlockFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Store\Model\Store;

/**
 * Class CreateCMSBlocks
 * @package Elogic\Blog\Setup\Patch\Data
 */
class CreateCMSBlocks implements DataPatchInterface
{
    /**
     * @var BlockFactory
     */
    protected $blockFactory;

    /**
     * @var ModuleDataSetupInterface
     */
    protected $moduleDataSetup;

    /**
     * CreateCMSBlocks constructor.
     * @param BlockFactory $blockFactory
     * @param ModuleDataSetupInterface $moduleDataSetup
     */
    public function __construct(
        BlockFactory $blockFactory,
        ModuleDataSetupInterface $moduleDataSetup
    ) {
        $this->blockFactory = $blockFactory;
        $this->moduleDataSetup = $moduleDataSetup;
    }

    /**
     * @return {@inheritdoc}
     */
    public static function getDependencies()
    {
        return [];
    }

    /**
     * @return {@inheritdoc}
     */
    public function getAliases()
    {
        return [];
    }

    public function apply()
    {
        $newCmsStaticBlock1 = [
            'title' => 'Elogic_Blog CMS Block 1',
            'identifier' => 'blog-cms-block-1',
            'content' => '<div class="cms-terms">First CMS Static Block</div>',
            'is_active' => 1,
            'stores' => Store::DEFAULT_STORE_ID
        ];
        $newCmsStaticBlock2 = [
            'title' => 'Elogic_Blog CMS Block 2',
            'identifier' => 'blog-cms-block-2',
            'content' => '<div class="cms-terms">Second CMS Static Block</div>',
            'is_active' => 1,
            'stores' => Store::DEFAULT_STORE_ID
        ];
        $this->moduleDataSetup->startSetup();
        $block = $this->blockFactory->create();
        $block->setData($newCmsStaticBlock1)->save();
        $block->clearInstance();
        $block = $this->blockFactory->create();
        $block->setData($newCmsStaticBlock2)->save();
        $this->moduleDataSetup->endSetup();
    }
}
