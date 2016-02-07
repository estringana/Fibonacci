<?php

namespace Acme\Printables;

interface Printable {
	public function rowToString($position, $value);
	public function toString($values);
}