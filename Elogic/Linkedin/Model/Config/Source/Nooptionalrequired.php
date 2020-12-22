<?php


namespace Elogic\Linkedin\Model\Config\Source;

/**
 * Class Nooptionalrequired
 * @package Elogic\Linkedin\Model\Config\Source
 */
class Nooptionalrequired
{
    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        return [
            ['value' => 0, 'label' => __('No')],
            ['value' => 1, 'label' => __('Optional')],
            ['value' => 2, 'label' => __('Required')]
        ];
    }
}
