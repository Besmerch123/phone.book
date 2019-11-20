<?php

namespace application\storage;

class Cookie
{

    public function create($name, $value = '', $expire = null, $path = '', $domain = '', $secure = false, $httpOnly = false)
    {

        if (is_null($expire))
            $expire = time() + 3600;

        setcookie($name, $value, $expire, $path, $domain, $secure, $httpOnly);
    }

    public function read($name)
    {
        if (isset($_COOKIE[$name])) {
            return $_COOKIE[$name];
        }
        return false;
    }

    public function update($name, $value, $expire = null)
    {
        if (isset($_COOKIE[$name])) {
            if (is_null($expire))
                $expire = time() + 3600;

            setcookie($name, $value, $expire);
        }
    }

    public function delete($name)
    {
        if (isset($_COOKIE[$name])) {
            setcookie($name, '', time() - 3600);
        }
    }
}