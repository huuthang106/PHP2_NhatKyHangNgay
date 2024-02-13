<?php
ob_start();
session_start();
require_once 'vendor/autoload.php';

use App\Core\Route as Router;
use App\Upload;
use App\Core\Database as Database;

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
    ->get('/', [App\Home::class, 'index'])
    ->post('/upload', [App\Home::class, 'upload'])
    ->get ('/login', [App\Login::class,'login'])
    ->post('/login', [App\Login::class, 'login'])
    ->get('/logout', [App\Login::class, 'logout'])
    ->get('/forgotpassword', [App\Login::class, 'fotgot'])
    ->post('/forgotpassword', [App\Login::class, 'fotgot'])
    ->get('/showpass', [App\Login::class, 'show_pass'])
    ->get ('/register', [App\Register::class,'register'])
    ->post('/register', [App\Register::class, 'register'])
    ;
   


echo $router->resolve($_SERVER['REQUEST_URI'], strtolower($_SERVER['REQUEST_METHOD']));






?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Lab6 Nguyen Huu Thang</title>
</head>

<body>

    <h1> lab6 Nguyễn Hữu Thắng PC06404</h1>
   
</body>

</html>
<?php
ob_end_flush();
?>
