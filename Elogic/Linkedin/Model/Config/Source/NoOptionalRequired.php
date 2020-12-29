<?php

namespace Elogic\Linkedin\Model\Config\Source;

/**
 * Class NoOptionalRequired
 * @package Elogic\Linkedin\Model\Config\Source
 */
class NoOptionalRequired
{
    const IS_INVISIBLE = 0;
    const IS_OPTIONAL = 1;
    const IS_REQUIRED = 2;
    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        return [
            ['value' => self::IS_INVISIBLE, 'label' => __('No')],
            ['value' => self::IS_OPTIONAL, 'label' => __('Optional')],
            ['value' => self::IS_REQUIRED, 'label' => __('Required')]
        ];
    }
}
