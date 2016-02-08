<?php

namespace Acme\Printables;

/**
 * HTML representation of the fibbonacci numbers
 * @category Free time
 * @package Fibonacci
 * @license http://www.opensource.org/licenses/bsd-license.php BSD License
 * @author Alejandro Estringana <estringana@gmail.com>
 */
class HTMLPrintable implements Printable
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
        return "<tr><td>$position</td><td>$value</td></tr>";
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
        $output = "<table>";
        $output  .= "<tr><td>Position</td><td>Value</td></tr>";

        if (! is_array($values) ) {
            throw new Acme\Exceptions\InvalidInputException('array');
        }

        foreach ($values as $position => $value) {
            $output .= $this->rowToString($position, $value);
        }

        $output .= "</div>";

        return $output;
    }
}