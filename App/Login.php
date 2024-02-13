<?php

namespace App;

use App\Core\Database;
use PDO;
use PDOException;

class Login
{
    public $user_id = null;
    public $email = null;
    public $password = null;
    public $name = null;
    public $phone = null;
    public $role = null;
    public $point = null;
    public $status = null;
    public $img = null;


    // Constructor
    // public function __construct($email, $password)
    // {
    //     $this->email = $email;
    //     $this->password = $password;
    // }

    public function login()
    {
        if (isset($_SESSION['user'])) {
            $user_id = $_SESSION['user']['user_id'];
            $name = $_SESSION['user']['name'];
            return "{$user_id} {$name} <a href='/logout'>Logout</a>";
        } else {
            $email = $_POST['email'];
            $pasword = $_POST['password'];
            $error =  $_SESSION['error'];
            if (isset($_POST['submit'])) {


                $this->getUser($email,   $pasword);
            }
            if (empty($error)) {
                return '<form action="/login" method="post">
                    <div class="form-group">
                    <label for="">Email</label>
                    <input type="text" name="email"  class ="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="password" name="password" class="form-control">
                    </div>
                
                    <button type="submit" name ="submit" class="btn btn-primary" value="submit">Submit</button>
                <a href="/register" class="btn btn-primary">Đăng ký</a>
                <a href="/forgotpassword" class="btn btn-primary">Quên mật khẩu</a>
                
                     <a href="/" class="btn btn-primary">Trang chủ</a>
                    
                    </form>

            ';
            } else {
                $_SESSION['error'] = null;
                return '<form action="/login" method="post">
                <div class="form-group">
                <label for="">Email</label>
                <input type="text" name="email"  class ="form-control">
                </div>
                <div class="form-group">
                    <label for="">Password</label>
                    <input type="password" name="password" class="form-control">
                </div>
                ' . ($error ? '<div class="alert alert-danger" role="alert">' . $error . '</div>' : '') . '
                <button type="submit" name ="submit" class="btn btn-primary" value="submit">Submit</button>
                <a href="/register" class="btn btn-primary">Đăng ký</a>
                <a href="/forgotpassword" class="btn btn-primary">Quên mật khẩu</a>
   
                <a href="/" class="btn btn-primary">Trang chủ</a>
                </form>
                
                ';
            }
        }
    }


    public function loginUser()
    {
        if (empty($this->email) || empty($this->password)) {
            header("location:/register?error =emptyInput");
            exit();
        }
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            header("location: /register?error= email");
            exit();
        }
        $this->getUser($this->email, $this->password);
    }
    public function logout()
    {
        session_unset();
        session_destroy();
        header("location:/");
    }
    protected function getUser($email, $password)
    {
        $error = '';
        // Kiểm tra password không trống
        if (empty($password) || empty($email)) {
            $error = "Không được để trống.";
        }
        // Kiểm tra email không trống và đúng định dạng
        else if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = "Email không hợp lệ.";
        } else {
            // Tiếp tục kiểm tra tài khoản và mật khẩu
            $db = new Database();
            $select = "SELECT * FROM users WHERE email = ? AND password = ? ";
            $result = $db->pdo_query_one($select, $email, $password);

            if ($result == true) {
                // Kiểm tra dữ liệu đăng nhập trước khi lưu vào session
                if (isset($result['user_id'], $result['email'], $result['password'])) {
                    // Lưu vào session
                    $_SESSION['user'] = $result;
                    header("location: /login");
                } else {
                    // Dữ liệu đăng nhập không hợp lệ
                    $error = "Tài khoảng mật khẩu không đúng.";
                }
            } else {
                // Dữ liệu không tồn tại, xử lý đăng nhập không thành công
                $error = "Tài khoảng mật khẩu không đúng.";
            }
        }

        // Gán giá trị lỗi vào SESSION để sử dụng ở nơi khác
        $_SESSION['error'] = $error;

        // Trả về giá trị lỗi để kiểm tra và hiển thị trong hàm login
        return header('location:/login');
    }
    public function fotgot()
    {
        $error = $_SESSION['error'];
        // $password = $_SESSION['password'];

        if (isset($_POST['submit'])) {
            $email = $_POST['email'];
            $this->forgot_password($email);
        }
        if (empty($error)) {
            return '<form action="/forgotpassword" method="post">
        <div class="form-group">
        <label for="">Email</label>
        <input type="text" name="email"  class ="form-control">
        </div>
        <a href="/login" class="btn btn-primary">Quay về</a>
    
        <button type="submit" name ="submit" class="btn btn-primary" value="submit">Submit</button>
        </form>';
        } else {
            $_SESSION['error'] = null;
            return '<form action="/forgotpassword" method="post">
            <div class="form-group">
            <label for="">Email</label>
            <input type="text" name="email"  class ="form-control">
            </div>
            <a href="/login" class="btn btn-primary">Quay về</a>
        
            <button type="submit" name ="submit" class="btn btn-primary" value="submit">Submit</button>
            ' . ($error ? '<div class="alert alert-danger" role="alert">' . $error . '</div>' : '') . '
            </form>';
        }
    }
    public function forgot_password($email)
    {
        $error = '';
        if (empty($email)) {
            $error = "Không được để trống.";
        }   // Kiểm tra email không trống và đúng định dạng
        else if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = "Email không hợp lệ.";
        } else {
            $db = new Database();
            $select = "SELECT password FROM users where email = ?";
            $result = $db->pdo_query_one($select, $email);
            // var_dump($result);
            if ($result == true) {
                # code...
                $_SESSION['password'] = $result['password'];
                // var_dump($result);
                return header('location: /showpass');
            } else {
                $error = "Tài khoảng không tồn tại.";
            }
        }
        $_SESSION['error'] = $error;
        return header('location: /forgotpassword');
    }
    public function show_pass()
    {
        $password = $_SESSION['password'];
        $_SESSION['password'] = null;
        return
            '
        
        <div class="alert alert-danger" role="alert">' . $password . '</div>
        <a href="/login" class="btn btn-primary">Đăng nhập</a>
    ';
    }
}
