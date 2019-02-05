<?php

namespace CBX;

class Cache
{
    private $cache;

    public function __construct($host, $port) {
        $this->cache = new \Memcached();
        $this->cache->addServer($host, $port);
    }

    public function set($key, $value) {
        $days14InSeconds = 3600 * 24 * 14;
        if (!$this->cache->set($key, $value, $days14InSeconds)) {
            throw new \Exception("I18N Memcached error. ".$this->cache->getResultMessage());
        }
        return true;
    }

    public function get($key) {
        try {
            return $this->cache->get($key);
        } catch (Exception $e) {
            throw new \Exception("I18N Memcached error. ".$e->getMessage());
        }
    }
}
