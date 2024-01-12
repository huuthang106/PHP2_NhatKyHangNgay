<?php
    // require 'Database.php';
    // spl_autoload_register(function($class){
    //     var_dump($class);
    //     include $class.'.php';
    // });
    require 'vendor/autoload.php';
    use App\Model\BaseModel  as MD;
    use App\Core\Route  as rt;
    use App\Controller\BaseControl  as CT;
    $db = new MD();
    $db ->hellModel();
    $db = new rt();
    $db ->helloRoute();
    $db = new CT();
    $db->helloController();
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