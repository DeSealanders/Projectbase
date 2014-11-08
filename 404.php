<?php
// Load default config
require('php/config/conf.default.php');
$defaultConfig = new DefaultConfig();
?>
<!DOCTYPE html>
<html>
<head>

</head>
<body>
<h1><?php echo $defaultConfig->getPageNotFoundMessage(); ?></h1>
</body>
</html>