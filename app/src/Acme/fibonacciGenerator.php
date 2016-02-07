<?php

require_once 'vendor/autoload.php';

Acme\App::start();

Acme\App::reset();

Acme\App::generateUpTo(30);

echo Acme\App::printAll(new Acme\Printables\PlainTextPrintable());