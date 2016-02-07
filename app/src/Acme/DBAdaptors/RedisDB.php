<?php

namespace Acme\DBAdaptors;

/**
 * The following class implement the DB layer by using redis as DB
 * @category Free_Time
 * @package Fibonacci
 * @license http://www.opensource.org/licenses/bsd-license.php BSD License
 * @author Alejandro Estringana <estringana@gmail.com>
 */
class RedisDB implements DBAdapter
{
    protected $_client;

    function __construct()
    {
        $this->_client = new \Predis\Client();
    }

    public function save($position, $value)
    {
        $this->_client->set($position, $value);
    }

    public function exists($position)
    {
        return $this->_client->exists($position);
    }

    public function get($position)
    {
        if (! $this->exists($position) ) {
            throw new \Acme\Exceptions\DB\PositionNotFoundException();            
        }

        return $this->_client->get($position);
    }

    public function reset()
    {
         $this->_client->flushall();
    }

    public function getAll()
    {
        $result = array();

        $values = $this->_client->keys('*');

        foreach ($values as $key) {
            $result[$key] = $this->get($key);
        }

        ksort($result);

        return $result;
    }
}