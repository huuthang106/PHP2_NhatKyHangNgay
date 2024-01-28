<?php

namespace App;

class Home
{
    public function index(): String
    {
        $error = $_SESSION['error'];
        if (empty($error)) {
            return <<<FORM
            <form action="/upload" method ="post" enctype="multipart/form-data">
            <input type ="file" name="receipt"/>
            <button type="submit"> Upload</button>
            
            </form>
            FORM;
        } else {
            $_SESSION['error']=null;
         echo '<br>';
            echo <<<FORM
            <form action="/upload" method ="post" enctype="multipart/form-data">
            <input type ="file" name="receipt"/>
            <button type="submit"> Upload</button>
                
                   
            </form>
            FORM;
            return ' ' . ($error ? '<div class="alert alert-danger" role="alert">' . $error . '</div>' : '') . '';
        }

        // return 'hi';
    }
    public function upload()
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        if (isset($_POST['submit']))
            $error = null;
        echo '<pre>';
        // var_dump($_FILES);
        $old_name = $_FILES['receipt']['name'];
        echo $old_name . '<br>';
        if (isset($_FILES['receipt']) && $_FILES['receipt']['error'] == UPLOAD_ERR_OK) {
            $file_extension = pathinfo($old_name, PATHINFO_EXTENSION);
            $new_name = date('YmdHis') . '.' . $file_extension;

            echo $new_name;
            echo' <a href="/" class="btn btn-primary">Quay về</a>';
            move_uploaded_file($_FILES['receipt']['tmp_name'], 'Public/Uploads/' . $new_name);
            // return header('location: /upload');
        } else {
            $error = 'Không có file tải lên';
            $_SESSION['error'] = $error;
            return header('location: /');
            // exit();
        }
       
    }
}
