
<h1>Bảng người dùng </h1>
<table class="rwd-table">
  <tr>
    <th>#</th>
    <th>Name</th>
    <th>Email</th>
    <th>Phone</th>
  </tr>
  <?Php 
  $i=0;
    foreach($list_user as $key => $user):
    
  ?>
  <tr>
    <td data-th="Movie Title"><?=$i++?></td>
    <td data-th="Genre"><?=$user['name']?></td>
    <td data-th="Year"><?=$user['email']?></td>
    <td data-th="Gross"><?=$user['phone']?></td>
  </tr>
 <?php
  endforeach;
 ?>
</table>


