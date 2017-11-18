<?php

namespace api;

use Exception\ProxyApiException;
use interfaces\ProxyAccessInstance;

class ProxyApi
{
    /** @var ProxyAccessInstance */
    private $access;
    private $curl;

    public function __construct(ProxyAccessInstance $access)
    {
        $this->access = $access;
        $this->curl = new CurlAdapter('https://proxy6.net/api/');
    }

    public function getBalance()
    {
        $data = $this->getContent('', []);
        return $data['balance'];
    }

    public function getCount()
    {
        $data = $this->getContent('getproxy', []);
        return $data['count'];
    }

    public function getProxy()
    {
        $data = $this->getContent('getcount', ['country' => 'ru']);
        return $data;
    }

    public function buy()
    {
        $data = $this->getContent('buy', ['country' => 'ru', 'count' => 1, 'period' => 30, 'version' => 4, 'type' => 'http']);
        return array_values($data['list'])[0];
    }

    public function prolong($id)
    {
        $data = $this->getContent('prolong', ['ids' => $id, 'period' => 31]);
        return array_values($data['list'])[0];
    }

    private function getContent($method, $params)
    {
        $this->curl->get($this->access->key . '/' . $method . '/', $params);
        if ($this->curl->getResponseCode() != 200) {
            throw new ProxyApiException($this, 'Не получил данные');
        }
        $data = json_decode($this->curl->getResponseBody(), true);
        if ($data['status'] === 'no') {
            throw new ProxyApiException($this, $data['error'], $data['error_id']);
        }
        return $data;
    }
}