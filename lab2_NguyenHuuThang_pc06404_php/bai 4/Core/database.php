<?php
    namespace Core;
    use mysqli;
    class Database{
        public function __construct(){
            $servername="localhost";
            $username ="root";
            $password="mysql";
            $conn = new mysqli($servername,$username,$password);
            if (!$conn) {
                die("Connection failed".$conn->connect_error());
            }
            echo "Connected successfully";
        }
        public function HelloWorld(){
            echo "Hello world";
        }
    }
?>