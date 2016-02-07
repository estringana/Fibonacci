<?php

namespace spec\Acme\Printables;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PlainTextPrintableSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Acme\Printables\PlainTextPrintable');
    }

   function it_should_return_the_position_arrow_value() {
   	$this->rowToString(5,2)->shouldReturn("5 --> 2 \n");
   }
}
