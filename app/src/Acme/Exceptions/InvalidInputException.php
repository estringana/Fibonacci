<?php

namespace Acme\Exceptions;

class InvalidInputException extends \Exception
{
    public function __construct(type)
    {
        parent::__construct("Invalid input passed. Excpected $type");
    }
}