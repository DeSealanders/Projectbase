<?php
// Load default config
require('php/config/conf.default.php');
?>
<!DOCTYPE html>
<html>
<head>

</head>
<body>
<h1><?php echo DefaultConfig::getInstance()->getPageNotFoundMessage(); ?></h1>
</body>
</html>