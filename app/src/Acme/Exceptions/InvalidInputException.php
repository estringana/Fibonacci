<?php

namespace Acme\Exceptions;

/**
 * Exception thrown when the param type isn't the one required
 * @category Free_Time
 * @package Fibonacci
 * @license http://www.opensource.org/licenses/bsd-license.php BSD License
 * @author Alejandro Estringana <estringana@gmail.com>
 */
class InvalidInputException extends \Exception
{
    public function __construct(type)
    {
        parent::__construct("Invalid input passed. Excpected $type");
    }
}