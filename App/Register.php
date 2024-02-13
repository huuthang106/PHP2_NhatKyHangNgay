<?php

namespace App;

use App\Core\Database;
use PDO;
use PDOException;

class Register
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
    public $pwdRepeat = null;

    public function register()
    {
        $error = $_SESSION['error'];
        if (isset($_POST['submit'])) {
            $this->name = $_POST['username'];
            $this->password = $_POST['password'];
            $this->pwdRepeat = $_POST['confirmpassword'];
            $this->email = $_POST['email'];
            $this->signupUser();
            header("loacation: /");
        }
        if (empty($error)) {
            return '
        <form action="/register" method="post">
        <div class="form-group">
        <label for="">Họ và tên</label>
        <input type="text" name="username"  class ="form-control">
    </div>
        <div class="form-group">
            <label for="">Email</label>
            <input type="text" name="email"  class ="form-control">
        </div>
        <div class="form-group">
            <label for="">Password</label>
            <input type="password" name="password" class="form-control">
        </div>
        <div class="form-group">
            <label for="">Password</label>
            <input type="password" name="confirmpassword" class="form-control">
        </div>
        <button type="submit" name ="submit" class="btn btn-primary" value="submit">Submit</button>
         <a href="/forgotpassword" class="btn btn-primary">Quên mật khẩu</a>
         <a href="/" class="btn btn-primary">Trang chủ</a>
        </form>
        ';
        } else {
            $_SESSION['error'] = null;
            return '
            <form action="/register" method="post">
            <div class="form-group">
            <label for="">Họ và tên</label>
            <input type="text" name="username"  class ="form-control">
        </div>
            <div class="form-group">
                <label for="">Email</label>
                <input type="text" name="email"  class ="form-control">
            </div>
            <div class="form-group">
                <label for="">Password</label>
                <input type="password" name="password" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Nhập lại mật khẩu</label>
                <input type="password" name="confirmpassword" class="form-control">
            </div>
            ' . ($error ? '<div class="alert alert-danger" role="alert">' . $error . '</div>' : '') . ' 
            <button type="submit" name ="submit" class="btn btn-primary" value="submit">Submit</button>
             <a href="/forgotpassword" class="btn btn-primary">Quên mật khẩu</a>
             <a href="/" class="btn btn-primary">Trang chủ</a>
            </form>
            ';
        }
    }
    public function pwdMarch($password, $confirmPassword)
    {
        // Kiểm tra xem mật khẩu và xác nhận mật khẩu có khớp nhau không
        return $password === $confirmPassword;
    }
        public function invalidEmail($email)
        {
       
            // Sử dụng hàm filter_var để kiểm tra tính hợp lệ của địa chỉ email
            return filter_var($email, FILTER_VALIDATE_EMAIL);
        }

    public function emptyInput()
    {
        // Kiểm tra trường dữ liệu từ form có trống không
        if (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['email']||$_POST['confirmpassword'])) {
            return false; // Có ít nhất một trường trống
        }

        return true; // Không có trường nào trống
    }

    protected function signupUser()
    {
        if ($this->emptyInput($_POST['username'], $_POST['password'], $_POST['email'],$_POST['confirmpassword']) == false) {
            $error = "Không được để trống.";
            $_SESSION['error'] = $error;
            header("location: /register?error=emtyInput");
            exit();
        }
        if ($this->invalidEmail(trim($_POST['email'])) == false) {
            $error = "Email không đúng.";
            $_SESSION['error'] = $error;
            header("location: /register?error=email");
            exit();
        }
        if ($this->pwdMarch($_POST['password'], $_POST['confirmpassword']) == false) {
            $error = "Mật khẩu không khớp.";
            $_SESSION['error'] = $error;
            header("location:/register?error=passwordWatch");
            exit();
        }
        $this->setUser($this->name, $this->password, $this->email);
    }
    protected function setUser($name, $password, $email)
    {
        $status = 0;
        // $now =date("Y-m-d H:i:s");
        $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
        $params = [$email, $hashedPwd, $name];
        $db = new Database();
        $INSERT = "INSERT INTO users(email,password,name)
         VALUES (?,?,?)";
        $result = $db->pdo_execute($INSERT,$email,$hashedPwd,$name);
        $resultCheck = '';
        if ($result) {
           return header('location: /login');
          
        } else {
            $resultCheck = false;
            $stmt = null;
            header('location: register?error=stmtfailed');
            exit();
        }
    }
}
