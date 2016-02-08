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
    /**
     * @var \Predis\Client()
     */
    protected $_client;

    /**
    * Default constructor
    *
    * @return void
    */
    function __construct()
    {
        $this->_client = new \Predis\Client();
    }

    public function save($position, $value)
    {
        $this->_client->set($position, $value);
    }

    /**
    * Check if the position exists on the DB
    * 
    * @param int $position of the fibonacci numbers we want to check
    *
    *
    * @return boolean
    */
    public function exists($position)
    {
        return $this->_client->exists($position);
    }

   /**
    * Get the value on the position specified
    * 
    * @param int $position of the fibonacci numbers we want to get
    *
    * @throws \Acme\Exceptions\DB\PositionNotFoundException()
    *
    * @return sring
    */
    public function get($position)
    {
        if (! $this->exists($position) ) {
            throw new \Acme\Exceptions\DB\PositionNotFoundException();            
        }

        return $this->_client->get($position);
    }

   /**
    * Remove all the fibonacci numbers generated
    * 
    *
    * @return void
    */
    public function reset()
    {
         $this->_client->flushall();
    }

    /**
    * Return all the values on the db
    *
    * @return array
    */
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