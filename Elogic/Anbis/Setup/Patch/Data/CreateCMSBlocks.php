<?php

namespace Elogic\Anbis\Setup\Patch\Data;

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
     * @return array
     */
    public static function getDependencies()
    {
        return [];
    }

    /**
     * @return array
     */
    public function getAliases()
    {
        return [];
    }

    /**
     * @return CreateCMSBlocks|void
     */
    public function apply()
    {
        $newCmsStaticBlock = [
            'title' => 'Elogic_Anbis CMS Block',
            'identifier' => 'some-dummy-cms-block',
            'content' => '<p><input id="name1" class="input-text" title="Name1" name="name1"' .
                'type="text" value="{{config path="web/my_group/dummy_cms_block"}}"></p>',
            'is_active' => 1,
            'stores' => Store::DEFAULT_STORE_ID
        ];
        $this->moduleDataSetup->startSetup();
        $block = $this->blockFactory->create();
        $block->setData($newCmsStaticBlock)->save();
        $this->moduleDataSetup->endSetup();
    }
}
