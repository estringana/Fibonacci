<?php

namespace Acme\Exceptions;

class InvalidPositionException extends \Exception
{
    public function __construct()
    {
        parent::__construct('Invalid position');
    }
}