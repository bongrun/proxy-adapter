<?php

namespace interfaces;

/**
 * Interface ProxyInterface
 * @package interfaces
 */
interface ProxyDataInterface
{
    public function getIp():string;

    public function getPort():int;

    public function getUser():string;

    public function getPassword():string;
}