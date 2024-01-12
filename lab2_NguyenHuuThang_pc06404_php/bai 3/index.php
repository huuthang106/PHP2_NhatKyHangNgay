<?php
    // require 'Database.php';
    spl_autoload_register(function($class){
        var_dump($class);
        include $class.'.php';
    });
    require 'vendor/autoload.php';
    use Core\Database as DB;
    $db = new DB();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>bai1</title>
</head>
<body>
  home page
</body>
</html>