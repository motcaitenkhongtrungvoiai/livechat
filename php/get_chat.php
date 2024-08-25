<?php
include_once "config.php";
session_start();

if (isset($_SESSION['unique_id'])) {

    $outgoing_id = mysqli_real_escape_string($conn, $_SESSION['unique_id']);
    $incoming_id = mysqli_real_escape_string($conn, $_REQUEST['incoming_id']);
    $output = '';
    $sql = "SELECT * FROM messenger LEFT JOIN users ON users.unique_id = messenger.outgoing_msg_id WHERE messenger.outgoing_msg_id ='$outgoing_id' AND messenger.incoming_msg_id ='$incoming_id' OR messenger.outgoing_msg_id = '$incoming_id'AND messenger.incoming_msg_id = '$outgoing_id' ORDER BY messenger.id_msg";
    $query = mysqli_query($conn, $sql);
    if (mysqli_num_rows($query) > 0) {
        foreach ( $query as $row) {
            if ($row['outgoing_msg_id'] == $outgoing_id) {
                $output .= '<div class="chat outgoing"> 
                <div class ="details">
                <p>' . htmlspecialchars($row['msg']) . '</p>
                </div>
                </div>';
            } 
            else {
                $output .= '<div class="chat incoming"> 
                <div class ="details">
                <p>' . htmlspecialchars($row['msg']) . '</p>
                </div>
                </div>';
            }  
            
        }
      
    } else {
        $output .= '<div class="text">khong co tin nhan</div>';
    }
        echo $output ;
} 

else {
    header("location:../user.php");
}

