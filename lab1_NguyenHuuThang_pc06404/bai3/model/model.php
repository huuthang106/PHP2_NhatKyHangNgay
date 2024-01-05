<?php
function get_user($email)
{
    include 'config.php';
   

    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    /* Get the result */
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_array(MYSQLI_ASSOC);
        return $row;
    }else{
        echo ' <label for="exampleFormControlInput1" class="form-label">Không tìm thấy thông tin</label>';
    }
    $connection->close();
}
