<?php

require_once 'vendor/autoload.php';

Acme\App::start();
echo Acme\App::printAll(new Acme\Printables\PlainTextPrintable());