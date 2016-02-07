<?php
require_once 'vendor/autoload.php';
Acme\App::start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Test</title>
</head>
<body>
	<?php echo Acme\App::printAll(new Acme\Printables\HTMLPrintable()); ?>
</body>
</html>
