<?php
include_once "config.php";
session_start();

if (isset($_SESSION['unique_id'])) {
    
    $outgoing_id = mysqli_real_escape_string($conn, $_SESSION['unique_id']);
    $incoming_id = mysqli_real_escape_string($conn, $_REQUEST['incoming_id']);
    $output = "";
    $sql="SELECT * FROM messenger LEFT JOIN users ON users.unique_id = messenger.outgoing_msg_id WHERE messenger.outgoing_msg_id ='$outgoing_id' AND messenger.incoming_msg_id ='$incoming_id' OR messenger.outgoing_msg_id = '$incoming_id'AND messenger.incoming_msg_id = '$outgoing_id' ORDER BY id_msg";
    $query= mysqli_query($conn,$sql);
    foreach($query as $data){
        echo $data['msg'];
    }
}

?>