<?php

namespace bongrun\traits;

trait ProxyDataTrait
{
    public $id;
    public $ip;
    public $port;
    public $user;
    public $password;
    public $type;
    public $date;
    public $dateEnd;
    public $active;
    public $count;

    public function getId(): int
    {
        return $this->id;
    }

    public function getIp(): string
    {
        return $this->ip;
    }

    public function getPort(): int
    {
        return $this->port;
    }

    public function getUser(): string
    {
        return $this->user;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function getDateEnd()
    {
        return $this->dateEnd;
    }

    public function getActive()
    {
        return $this->active;
    }

    public function getCount()
    {
        return $this->count;
    }

    public function setId($id)
    {
        return $this->id = $id;
    }

    public function setIp($ip)
    {
        return $this->ip = $ip;
    }

    public function setPort($port)
    {
        return $this->port = $port;
    }

    public function setUser($user)
    {
        return $this->user = $user;
    }

    public function setPassword($password)
    {
        return $this->password = $password;
    }

    public function setType($type)
    {
        return $this->type = $type;
    }

    public function setDate($date)
    {
        return $this->date = $date;
    }

    public function setDateEnd($dateEnd)
    {
        return $this->dateEnd = $dateEnd;
    }

    public function setActive($active)
    {
        return $this->active = $active;
    }

    public function setCount($count)
    {
        return $this->count = $count;
    }
}