<?php
    
    require_once 'vendor/autoload.php';
    use App\Core\Route as Router;
    // use App\Home;
    // use App\Invoices;
    $router = new Router();
    // bai3
    // $router->register(
    //     '/',
    //     function(){
    //         echo 'Home';
    //     }
    // );
    // bai 4
    $router
    ->register('/',[App\Home::class,'index'])
    ->register('/invoices',[App\Invoices::class, 'index'])
    ->register('/invoices/create',[App\Invoices::class, 'create']);
    echo $router->resolve($_SERVER['REQUEST_URI']);



    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Lab4 Nguyen Huu Thang</title>
</head>
<body>
<h1> lab4 Nguyễn Hữu Thắng PC06404</h1>
</body>
</html>