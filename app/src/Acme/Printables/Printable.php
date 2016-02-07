<?php

namespace Acme\Printables;

/**
 * Interface which defines the contact of the output
 * 
 *  @category Free_Time
 *  @package Fibonacci
 *  @license http://www.opensource.org/licenses/bsd-license.php BSD License
 *  @author Alejandro Estringana <estringana@gmail.com>
 */
interface Printable
{
    public function rowToString($position, $value);
    public function toString($values);
}