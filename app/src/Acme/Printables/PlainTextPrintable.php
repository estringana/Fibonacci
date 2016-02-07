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
    public function rowToString($position, $value)
    {
        return "$position --> $value \n";
    }

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