<?php

namespace CBX;

class Cache
{
    private $cache;

    public function __construct($host, $port) {
        try {
            $this->cache = new \Memcached();
            $this->cache->addServer($host, $port);
        } catch (Exception $e) {
            throw new \Exception("I18N Memcached error. ".$e->getMessage());
        }
    }

    public function set($key, $value, $expiration = 3600 * 24 * 14) {
        try {
            if (!$this->cache->set($key, $value, $expiration)) {
                throw new \Exception("I18N Memcached error. ".$this->cache->getResultMessage());
            } else {
                return true;
            }
        } catch (Exception $e) {
            throw new \Exception("I18N Memcached error. ".$e->getMessage());
        }
        return false;
    }

    public function get($key) {
        try {
            return $this->cache->get($key);
        } catch (Exception $e) {
            throw new \Exception("I18N Memcached error. ".$e->getMessage());
        }
        return false;
    }
}
