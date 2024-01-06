<?php
   include "model/config.php";
    class User{
        var $user_id = null;
        var $email = null;
        var $password = null;
        var $name = null;
        var $phone = null ;
        var $role = null;
        var $point = null;
        public function get_all_user(){
            $db = new connect();
            $select= "select * from users";
            $result = $db->pdo_query($select);
            if($result){
                return $result;
            }else{
                echo 'Không có thông tin';
            }
        }
    }
?>