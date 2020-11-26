<?php

namespace Elogic\Blog\Setup\Patch\Data;

use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;

/**
 * Class EnableDirectiveParsing
 * @package Elogic\Blog\Setup\Patch
 */
class CreateArticles implements DataPatchInterface
{

    /**
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;
    /**
     * @var \Elogic\Blog\Model\BlogFactory
     */
    private $articleFactory;

    public function __construct(
        \Elogic\Blog\Model\BlogFactory $blogFactory
    )
    {
        $this->articleFactory = $blogFactory;
    }

    /**
     * PatchInitial constructor.
     * @param ModuleDataSetupInterface $moduleDataSetup
     */


    /**
     * {@inheritdoc}
     */
    public function apply()
    {
        $article = $this->articleFactory->create();
        $dataArray = [
            [
                "author" => "Vadym",
                "title" => "Ja dub-derevo",
                "desc" => "Test",
                "content" => "Some content",
                "status" => 1,
                "enabled" => 1
            ],
            [
                "author" => "Vasya",
                "title" => "Ja tozhe",
                "desc" => "Test2",
                "content" => "Some content11111",
                "status" => 1,
                "enabled" => 1
            ],
            [
                "author" => "Petya",
                "title" => "A ja crevedko",
                "desc" => "Test3",
                "content" => "Some content2222",
                "status" => 1,
                "enabled" => 1
            ],
        ];
        foreach ($dataArray as $data){
            $article->setData($data);
            $article->save();
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function getDependencies()
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function getAliases()
    {
        return [];
    }
}
