<?php

namespace Acme;

use Acme\DBAdaptors\FileSystemDB;
use Acme\DBAdaptors\RedisDB;
use Acme\Generator\Fibonacci;
use Acme\Printables\Printable;

/**
 * Class in charge of managing the whole application
 * @category Free_Time
 * @package Fibonacci
 * @license http://www.opensource.org/licenses/bsd-license.php BSD License
 * @author Alejandro Estringana <estringana@gmail.com>
 */
class App
{
    /**
     * @var \Acme\DBAdaptors\DBAdapter
     */
    static protected $_db = null;

    /**
     * @var \Acme\Generator\Fibonacci
     */
    static protected $_generator = null;

    /**
    * Initializes the application
    *
    *  @return void
    */
    public static function start()
    {
        self::$_db = new RedisDB();
        //Uncomment the next line out for using the file system as DB
        // self::$_db = new FileSystemDB();

        self::$_generator = new Fibonacci(self::$_db);
    }

   /**
    * Print all the fibonacci numbers using a printable specified
    *
    * @param Printable $printable which will be charge of transforms value on the output specified
    * 
    *  @return string
    */
    public static function printAll(Printable $printable)
    {
        return $printable->toString(self::$_db->getAll());
    }

    /**
    * Generates fibonacci numbers up to the position specified
    *
    * @param int $position position up to the one we want to generate
    * 
    *  @return void
    */
    public static function generateUpTo($position)
    {
        for ( $i = 1; $i <= $position; $i++) {
            self::$_generator->generate($i);
        }
    }

   /**
    * Reset all the values generated
    *  
    *  @return void
    */
    public static function reset()
    {
        self::$_db->reset();
    }

}