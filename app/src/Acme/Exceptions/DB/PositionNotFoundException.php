<?php

namespace Acme\Exceptions\DB;

class PositionNotFoundException extends \Exception
{
    public function __construct()
    {
        parent::__construct('Position not found');
    }
}