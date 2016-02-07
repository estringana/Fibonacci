<?php

namespace Acme;

use Acme\DBAdaptors\FileSystemDB;
use Acme\DBAdaptors\RedisDB;
use Acme\Generator\Fibonacci;
use Acme\Printables\Printable;

class App
{
	static protected $_db = null;
	static protected $_generator = null;

	public static function start(){
		self::$_db = new RedisDB();
		//Uncomment the next line out for using the file system as DB
		// self::$_db = new FileSystemDB();
		self::$_generator = new Fibonacci(self::$_db);
	}

	public static function printAll(Printable $printable){
		return $printable->toString(self::$_db->getAll());
	}

}