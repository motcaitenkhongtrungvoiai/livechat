
<?php
session_start();
if(isset($_SESSION['unique_id'])){
    include_once("config.php");
    $logout_id = mysqli_real_escape_string($conn,$_GET['logout_id']);
    $status="offline now";
    $sql=mysqli_query($conn,"update users set status = '{$status}' where unique_id = '{$_GET['logout_id']}'");
    if($sql){
        session_unset();
        session_destroy();
        header("location: ../login.php");
    }
}
else{
    header("location:../user.php");
}
?>