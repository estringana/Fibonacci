<?php

namespace Acme\Exceptions;

/**
 * Exception thrown when a position is not valid
 * @category Free_Time
 * @package Fibonacci
 * @license http://www.opensource.org/licenses/bsd-license.php BSD License
 * @author Alejandro Estringana <estringana@gmail.com>
 */
class InvalidPositionException extends \Exception
{
    /**
    * Default constructor
    *
    * @return void
    */	
    public function __construct()
    {
        parent::__construct('Invalid position');
    }
}