<?php

namespace Acme\Printables;

class HTMLPrintable implements Printable {
	public function rowToString($position, $value) {
		return "<tr><td>$position</td><td>$value</td></tr>";
	}

	public function toString($values){
		$output = "<table>";
		$output  .= "<tr><td>Position</td><td>Value</td></tr>";

		if ( ! is_array($values) ){
			throw new Acme\Exceptions\InvalidInputException('array');
		}

		foreach ($values as $position => $value) {
			$output .= $this->rowToString($position, $value);
		}

		$output .= "</div>";

		return $output;
	}
}