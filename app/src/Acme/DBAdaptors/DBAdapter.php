<?php
namespace Acme\DBAdaptors;
/**
 * Interface which define the adapter pattern
 * @category Free_Time
 * @package Fibonacci
 * @license http://www.opensource.org/licenses/bsd-license.php BSD License
 * @author Alejandro Estringana <estringana@gmail.com>
 */
interface DBAdapter
{
    /**
     * Save the value into the position specified
     * 
    * @param int $position of the fibonacci numbers we want to save
    * @param int $value of the fibonacci numbers we want to save
    *
    * @return void
    */
    public function save($position, $value);
    
    /**
    * Get the value on the position specified
    * 
    * @param int $position of the fibonacci numbers we want to get
    *
    * @throws \Acme\Exceptions\DB\PositionNotFoundException()
    *
    * @return sring
    */
    public function get($position);

    /**
    * Remove all the fibonacci numbers generated
    * 
    *
    * @return void
    */
    public function reset();

    /**
    * Check if the position exists on the DB
    * 
    * @param int $position of the fibonacci numbers we want to check
    *
    *
    * @return boolean
    */
    public function exists($position);

    /**
    * Return all the values on the db
    *
    * @return array
    */
    public function getAll();
}