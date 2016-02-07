<?php

namespace Acme\DBAdaptors;

interface DBAdapter {
	public function save($position, $value);
	public function get($position);
	public function reset();
	public function exists($position);
	public function getAll();
}