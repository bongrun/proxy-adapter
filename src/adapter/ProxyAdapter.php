<?php

namespace adapter;

use api\ProxyApi;
use interfaces\ProxyAccessInstance;
use exception\ProxyAdapterException;
use interfaces\ProxyDataInterface;
use Model\Profile;

class ProxyAdapter
{
    /** @var ProxyAccessInstance */
    private $proxyAccess;
    /** @var Profile */
    private $profile;

    public function __construct(ProxyAccessInstance $proxyAccess, Profile $profile)
    {
        $this->proxyAccess = $proxyAccess;
        $this->profile = $profile;
    }

    public function getProxy($availableForCount = 1): ProxyDataInterface
    {
        if ($this->profile->getProxy() && $this->isCheck($this->profile->getProxy())) {
            return $this->profile->getProxy();
        }
        /** @var Proxy[] $proxies */
        $proxies = Proxy::find(["conditions" => ['count' => $availableForCount]]);
        foreach ($proxies as $proxy) {
            $data = $this->profile::find(["conditions" => ['proxyId' => $proxy->getId()]]);
            if (count($data) < $availableForCount && $this->isCheck($proxy)) {
                return $proxy;
            }
        }
        $proxyApi = new ProxyApi($this->proxyAccess);
        $data = $proxyApi->buy();
        $proxy = new Proxy();
        $proxy->id = $data['id'];
        $proxy->ip = $data['ip'];
        $proxy->port = $data['port'];
        $proxy->user = $data['user'];
        $proxy->password = $data['pass'];
        $proxy->type = $data['type'];
        $proxy->date = $data['date'];
        $proxy->dateEnd = $data['date_end'];
        $proxy->active = $data['active'];
        $proxy->count = $availableForCount;
        $proxy->save();

        if(!$this->isCheck($proxy)) {
            throw new ProxyAdapterException($this, 'Прокси левая купилась');
        }
        return $proxy;
    }

    /**
     * Проверка прокси
     *
     * @param ProxyDataInterface $proxy
     * @param null  $url
     *
     * @return bool
     */
    private function isCheck(ProxyDataInterface $proxy, $url = null)
    {
        // todo продление если надо
        // todo
        $this->profile->proxyId = $proxy->getId();
        return true;
    }
}