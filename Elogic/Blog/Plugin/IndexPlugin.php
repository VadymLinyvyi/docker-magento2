<?php


namespace Elogic\Blog\Plugin;

/**
 * Class IndexPlugin
 * @package Elogic\Blog\Plugin
 */
class IndexPlugin
{
    /**
     * @param $subject
     * @param $result
     * @param $a
     * @return mixed
     */
    public function afterTempForPlugin($subject, $result, $a)
    {
        return $result+$a;
    }

    /**
     * @param $subject
     * @param $a
     * @param $b
     * @param $c
     * @return int[]
     */
    public function beforeTempForPlugin($subject, $a, $b, $c)
    {
        return [$a+5, $b-8, $c+99];
    }

    public function aroundTempForPlugin($subject, $proceed, $result, $a, $b, $c)
    {
        $a=$b+1;
        $c=$a-$b;
        $proceed = $proceed($a, $b, $c)-$b;
        return $proceed+$a;
    }
}
