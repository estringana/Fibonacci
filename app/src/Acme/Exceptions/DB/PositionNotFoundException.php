<?php

namespace Acme\Exceptions\DB;

/**
 * Exception thrown when a position is not found on the db
 * @category Free_Time
 * @package Fibonacci
 * @license http://www.opensource.org/licenses/bsd-license.php BSD License
 * @author Alejandro Estringana <estringana@gmail.com>
 */
class PositionNotFoundException extends \Exception
{

    /**
    * Default constructor
    *
    * @return void
    */	
    public function __construct()
    {
        parent::__construct('Position not found');
    }
}