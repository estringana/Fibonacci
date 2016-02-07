<?php

namespace spec\Acme\DBAdaptors;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use \Acme\Exceptions\DB\PositionNotFoundException;

class RedisDBSpec extends ObjectBehavior
{
	function it_is_initializable()
	{
		$this->shouldHaveType('Acme\DBAdaptors\RedisDB');
	}

	function it_should_save_5_on_file_6() {
		$this->save(6,5);

		$this->get(6)->shouldReturn("5");
	}

	function it_should_throw_exception_position_not_found_when_getting_9999999() {
		$this->shouldThrow(new PositionNotFoundException("Position not found"))->during('get', array(9999999));
	}

	function it_should_not_found_6_when_reseting(){
		$this->save(6,5);

		$this->reset();

		$this->shouldThrow(new PositionNotFoundException("Position not found"))->during('get', array(6));
	}

	function it_should_return_array_with_two_rows(){
		$this->save('John','Doe');
		$this->save('Lorem','Ipsum');

		$this->getAll()->shouldHaveKey('John');
		$this->getAll()->shouldContain('Doe');

		$this->getAll()->shouldHaveKey('Lorem');
		$this->getAll()->shouldContain('Ipsum');
	}
}
