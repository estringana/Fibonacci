<?php

namespace Acme\DBAdaptors;

class RedisDB implements DBAdapter {
	protected $_client;

	function __construct(){
		$this->_client = new \Predis\Client();
	}

	public function save($position, $value){
		$this->_client->set($position, $value);
	}

	public function exists($position){
		return $this->_client->exists($position);
	}

	public function get($position){
		if (! $this->exists($position) ) {
			throw new \Acme\Exceptions\DB\PositionNotFoundException();			
		}

		return $this->_client->get($position);
	}

	public function reset()
	{
		 $this->_client->flushall();
	}

	public function getAll(){
		$result = array();

		$values = $this->_client->keys('*');

		foreach ($values as $key) {
			$result[$key] = $this->get($key);
		}

		ksort($result);

		return $result;
	}
}