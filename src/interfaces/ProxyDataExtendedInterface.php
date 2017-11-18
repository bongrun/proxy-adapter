<?php

namespace interfaces;

/**
 * Interface ProxyDataExtendedInterface
 * @package interfaces
 */
interface ProxyDataExtendedInterface extends ProxyDataInterface
{
    public function getCount();

    public function setCount($count);

    /**
     * @param $count
     * @return static[]
     */
    public static function getProxiesByCount($count):array;

    public function save();
}