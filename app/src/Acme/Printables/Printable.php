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
    /**
    * Prints a row with the specified position and value
    * 
    * @param int $position of the fibonacci numbers we want to print
    * @param int $value of the fibonacci numbers we want to print
    *
    * @return string
    */
    public function rowToString($position, $value);

    /**
    * Prints the whole matrix of values specified
    * 
    * @param array $values where all the fibonacci numbers are generated
    *
    * @return void
    */
    public function toString($values);
}