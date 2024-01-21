<?php
    
    require_once 'vendor/autoload.php';
    use  App\Core\Form;
    use  App\Core\Field;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Lab3 Nguyen Huu Thang</title>
</head>
<body>
    <div class="container">
        <h1>Create an account</h1>
        <?php  $form = Form::begin('','post');  ?>
        <div class="row">
        <div class="mb-3">
                <?php   echo $form->field('firstname'); ?>

            </div>
            <div class="mb-3">
                <?php echo $form->field('lastname');?>
            </div>
        </div>
        <?php echo $form->field('email');?>
        <?php echo $form->field('password')->passwordField();?>
        <?php echo $form->field('confirmPassword')->passwordField();?>
        <div class="btn-group" role="group" aria-label="Basic example" style="margin-top: 2%;">
        <button type="submit" class="btn btn-primary" >Submit</button>
        </div>
    </div>
</body>
</html>