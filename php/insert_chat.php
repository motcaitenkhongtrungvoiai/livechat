<?php
session_start();
include_once ("config.php");
$outcoming_id = mysqli_real_escape_string($conn, $_SESSION['unique_id']);
$incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
$msg = mysqli_real_escape_string($conn, $_POST["message"]);

if (isset($_SESSION['unique_id'])) {
    $sql = "INSERT INTO `messenger`( `incoming_msg_id`, `outgoing_msg_id`, `msg`) VALUES ('{$incoming_id}','{$outcoming_id}','{$msg}') ";
    $query = mysqli_query($conn, $sql);
}
else{
    header("location:../login.php");
}



?>