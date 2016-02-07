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
    public function rowToString($position, $value)
    {
        return "<tr><td>$position</td><td>$value</td></tr>";
    }

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