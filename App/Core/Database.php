<?php

namespace App\Core;

use Exception;
use PDO;
use PDOException;

class Database
{
    public function pdo_get_connection()
    {
        $servername = "localhost";
        $username = "root";
        $password = "mysql";
        try {
            //code...
            $conn = new PDO("mysql:host=$servername;dbname=nhatky", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "kết nối thành công";
            return $conn;
        } catch (PDOException $e) {
            //throw $th;
            echo "lỗi kết nối " . $e->getMessage();
        }
    }
    //sql,...,id
    //vd:  "insert into loai(tenloai)values(?)","laptop"
    //vd "update loai set tenloai=? where ma_loai=?", "laptop","1"
    function pdo_execute($sql)
    {
        $sql_args = array_slice(func_get_args(), 1);
        try {
            //code...
            $conn = $this->pdo_get_connection(); //kết nối csdl
            $stmt = $conn->prepare($sql);
            $stmt->execute($sql_args); //thực thi và truyền dữ liệ của biến vào 
            return $stmt;
        } catch (PDOException $e) {
            //throw $th;
            throw $e;
        } finally {
            unset($conn);
        }
    }

    //lấy nhiều dòng
    function pdo_query($sql)
    {
        $sql_args = array_slice(func_get_args(), 1);
        try {
            $conn = $this->pdo_get_connection();
            $stmt = $conn->prepare($sql);
            $stmt->execute($sql_args);
            $rows = $stmt->fetchAll();
            return $rows;
        } catch (PDOException $e) {
            throw $e;
        } finally {
            unset($conn);
        }
    }
    //trả 1 kết quả
    function pdo_query_one($sql)
    {
        $sql_args = array_slice(func_get_args(), 1);
        try {
            $conn = $this->pdo_get_connection();
            $stmt = $conn->prepare($sql);
            $stmt->execute($sql_args);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row;
        } catch (PDOException $e) {
            throw $e;
        } finally {
            unset($conn);
        }
    }

    function pdo_query_value($sql)
    {
        $sql_args = array_slice(func_get_args(), 1);
        try {
            $conn = $this->pdo_get_connection();
            $stmt = $conn->prepare($sql);
            $stmt->execute($sql_args);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return array_values($row)[0];
        } catch (PDOException $e) {
            throw $e;
        } finally {
            unset($conn);
        }
    }
}
