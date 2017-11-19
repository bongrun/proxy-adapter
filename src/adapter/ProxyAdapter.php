<?php

namespace bongrun\adapter;

use bongrun\api\Proxy6;
use bongrun\interfaces\ProfileInterface;
use bongrun\interfaces\ProxyAccessInstance;
use bongrun\exception\ProxyAdapterException;
use bongrun\interfaces\ProxyDataExtendedInterface;
use bongrun\interfaces\ProxyDataInterface;

class ProxyAdapter
{
    /** @var ProxyAccessInstance */
    private $proxyAccess;
    /** @var ProfileInterface */
    private $profile;
    /** @var ProxyDataExtendedInterface|string */
    private $proxyClass;

    public function __construct(ProxyAccessInstance $proxyAccess, ProfileInterface $profile, string $proxyClass)
    {
        $this->proxyAccess = $proxyAccess;
        $this->profile = $profile;
        $this->proxyClass = $proxyClass;
    }

    public function getProxy($availableForCount = 1): ProxyDataInterface
    {
        if ($this->profile->getProxy() && $this->isCheck($this->profile->getProxy())) {
            return $this->profile->getProxy();
        }
        $proxies = $this->proxyClass::getProxiesByCount($availableForCount);
        foreach ($proxies as $proxy) {
            if ($this->profile::countProfilesByProxy($proxy) < $availableForCount && $this->isCheck($proxy)) {
                return $proxy;
            }
        }
        $proxyApi = new Proxy6($this->proxyAccess, $this->proxyClass);
        /** @var ProxyDataExtendedInterface $proxy */
        $proxy = $proxyApi->buy();
        if(!$this->isCheck($proxy)) {
            throw new ProxyAdapterException('Прокси левая купилась');
        }
        $proxy->save();
        $this->profile->setProxy($proxy);
        $this->profile->save();
        return $proxy;
    }

    /**
     * Проверка прокси
     *
     * @param ProxyDataExtendedInterface $proxy
     * @param null $url
     * @return bool
     */
    private function isCheck(ProxyDataExtendedInterface $proxy, $url = null)
    {
        // todo продление если надо
        // todo
        // $this->profile->proxyId = $proxy->getId();
        return true;
    }
}