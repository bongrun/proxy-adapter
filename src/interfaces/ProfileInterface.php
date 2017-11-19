<?php

namespace bongrun\interfaces;

/**
 * Interface ProfileInterface
 * @package interfaces
 */
interface ProfileInterface
{
    public function getProxy():ProxyDataExtendedInterface;

    public static function countProfilesByProxy(ProxyDataExtendedInterface $proxy):int;

    public function setProxy(ProxyDataExtendedInterface $proxy);

    public function save();
}