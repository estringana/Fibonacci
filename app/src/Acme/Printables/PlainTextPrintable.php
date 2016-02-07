<?php

namespace Acme\Printables;

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