<?php

namespace spec\Acme\Generator;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Acme\DBAdaptors\FileSystemDB;

class FibonacciSpec extends ObjectBehavior
{
    function let(){
            $db = new FileSystemDB('./testFileSystem/');
            $db->reset();

            $this->beConstructedWith($db);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Acme\Generator\Fibonacci');
    }

    function it_should_return_1_when_1() {
    	$this->generate(1)->shouldReturn(1);
    }

    function it_should_return_an_expception_when_0() {
        $this->shouldThrow(new \Acme\Exceptions\InvalidPositionException("Invalid position"))->during('generate', array(0));
    }

     function it_should_return_1_when_2() {
    	$this->generate(2)->shouldReturn(1);
    }

    function it_should_return_2_when_3() {
    	$this->generate(3)->shouldReturn(2);
    }

    function it_should_return_21_when_8() {
    	$this->generate(8)->shouldReturn(21);
    }
}
