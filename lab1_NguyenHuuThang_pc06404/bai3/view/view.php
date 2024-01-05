
<?php
if(isset($user)){
    echo ' <label for="exampleFormControlInput1" class="form-label">'.$user['name'].'</label>';
}
 
?>
<form action="" method="post">
    <div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">Email address</label>
  <input type="email" name= "email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
</div>
<div class="mb-3">
 <input type="submit" name="" id="">
</div>
</form>