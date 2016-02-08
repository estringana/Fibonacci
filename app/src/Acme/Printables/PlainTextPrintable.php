<?php

namespace Acme\Printables;

/**
 * Plain text table  of the fibbonacci numbers
 * @category Free_Time
 * @package Fibonacci
 * @license http://www.opensource.org/licenses/bsd-license.php BSD License
 * @author Alejandro Estringana <estringana@gmail.com>
 */
class PlainTextPrintable implements Printable
{
    /**
    * Prints a row with the specified position and value
    * 
    * @param int $position of the fibonacci numbers we want to print
    * @param int $value of the fibonacci numbers we want to print
    *
    * @return string
    */
    public function rowToString($position, $value)
    {
        return "$position --> $value \n";
    }

    /**
    * Prints the whole matrix of values specified
    * 
    * @param array $values where all the fibonacci numbers are generated
    *
    * @return void
    */
    public function toString($values)
    {
        $output  = "Position --> Value\n";

        if (! is_array($values) ) {
            throw new Acme\Exceptions\InvalidInputException('array');
        }

        foreach ($values as $position => $value) {
            $output .= $this->rowToString($position, $value);
        }

        return $output;
    }
}