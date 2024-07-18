<?php session_start(); ?>
<?php
include_once ("config.php");
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

if (!empty($email) && !empty($password)) {

    $sql = mysqli_query($conn, "select* from `users` where `email`='{$email}'");
    if (mysqli_num_rows($sql) > 0) {
        $data = mysqli_fetch_assoc($sql);
        if ($data['password'] === $password) {
            $status = "Online";
            $sql2 = mysqli_query($conn, "UPDATE `users` SET `status`='{$status}' where `unique_id`='{$data['unique_id']}'");
            if ($sql2) {
                $_SESSION['unique_id'] = $data['unique_id'];
                echo "success";
            } else {
                "có gì đó đéo ổn với sever thử lại đi";
            }
        } else {
            echo "email hoặc mật khẩu không đúng";
        }
    } else {
        echo "email chưa tồn tại bạn có muốn tạo tài khoản mới?";
    }

} else {
    echo "tất cả các ô trống cần được điền thông tin ";
}

?>