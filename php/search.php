<?php session_start(); ?>

<?php

include_once ("config.php");

$outgoing_id = $_SESSION['unique_id'];
$searchTerm = mysqli_real_escape_string($conn, $_REQUEST['searchTerm']);
$sql = "select * from `users` where not `unique_id` = '{$outgoing_id}' and (`fname` LIKE '%{$searchTerm}%' or `lname` LIKE '%{$searchTerm}%')";
$output = "";
$query = mysqli_query($conn, $sql);
if (mysqli_num_rows($query) > 0 && $_REQUEST['searchTerm']!="") {
   include_once "data.php";
}

else {
    $output .= "khong tim thay nguoi dung ";
}
echo $output;
?>