<?php
session_start();

include_once "config.php";

$fname = mysqli_real_escape_string($conn, $_POST["fname"]);
$lname = mysqli_real_escape_string($conn, $_POST["lname"]);
$email = mysqli_real_escape_string($conn, $_POST["email"]);
$password = mysqli_real_escape_string($conn, $_POST["password"]);

if (!empty($fname) && !empty($lname) && !empty($email) && !empty($password)) {
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $sql = mysqli_query($conn, "SELECT * From `users` WHERE `email`='{$email}'");
        if (mysqli_num_rows($sql) > 0) {
            echo "email đã tồn tại";
        } else {
            if (isset($_FILES['image'])) {
                $image_name = $_FILES['image']['name'];
                $tmp_name = $_FILES['image']['tmp_name'];
                $image_type = $_FILES['image']['type'];

                //kiểm tra xem phần tử cuối của file có hợp lệ hay không
                $image_explode = explode('.', $image_name);
                $image_ext = end($image_explode);
                $extensions = ["jpeg", "png", "jpg"];

                // kiểm tra phần tử cuối có đuôi jpeg,png,jpg hay không
                if (in_array($image_ext, $extensions) === true) {
                    $type = ["image/jpg", "image/jpeg", "image/png"];
                    if (in_array($image_type, $type) === true) {
                        $time = time();
                        $new_image_name = $time . $image_name;
                        if (move_uploaded_file($tmp_name,  'img/'. $new_image_name)) {
                            $ran_id = mt_rand(time(), 100000000000);
                            $status = "Online";
                            // có thể mã hóa mật khẩu người dùng bằng hàm password_hasn() để đưa vào CSDL

                            $insert_query = mysqli_query($conn, "INSERT INTO `users`( `unique_id`, `fname`, `lname`, `email`, `password`, `status`,`img`) VALUES ('{$ran_id}','{$fname}','{$lname}','{$email}','{$password}','{$status}','{$new_image_name}')");
                              if($insert_query){
                                $select_sql2=mysqli_query($conn,"select *from `users` where `email`='{$email}'");
                                if(mysqli_num_rows($select_sql2)>0){
                                    $result=mysqli_fetch_assoc($select_sql2);
                                    $_SESSION['unique_id']=$result['unique_id'];
                                    echo "success";
                                }
                              }

                        } else {
                            echo "có gì đó đéo ổn với đống code này , làm ơn thử lại";
                        }
                    } else {
                        echo "chỉ nhét được file png,jpeg,jpg thôi má ơi";
                    }
                } else {
                    echo "làm ơn nhét file ảnh vào đi";
                }
            }
        }

    } else {
        echo "$email không hợp lệ ";
    }

} else {
    echo "tất cả các cột cần được nhập";
}
