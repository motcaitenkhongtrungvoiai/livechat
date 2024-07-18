
<?php

while ($row = mysqli_fetch_assoc($query)) {
    $sql2 = " SELECT * from `messenger` where `incoming_msg_id` = '{$row['unique_id']}'
    or `outgoing_msg_id` = '{$outgoing_id}'
    or `incoming_msg_id` = '{$outgoing_id}' order by `id_msg` desc limit 1
    ";
    $query2 = mysqli_query($conn, $sql2);
    $row2 = mysqli_fetch_assoc($query2);
    (mysqli_num_rows($query2) > 0) ? $result = $row2["msg"] : $result = "không có tin nhắn nào";
    (strlen($result) > 28) ? $msg = substr($result, 0, 28) . '...' : $msg = $result;
    if (isset($row2['outgoing_msg_id'])) {
        ($outgoing_id == $row2['outgoing_msg_id']) ? $you = "You: " : $you = "";
    } else {
        $you = "";
    }
    ($row['status'] == "offline now") ? $offline = "offline" : $offline = "";
    ($outgoing_id == $row['unique_id']) ? $hid_me = "hide" : $hid_me = "";
    $output .= '<a href="chat.php?user_id=' . $row['unique_id'] . ' ">
    <div class="content">
    <img src="php/img/' . $row['img'] . '">
    <div class="details">
    <span>' .
        $row['fname'] . " " . $row['lname']. '
    </span>
    <p>'. $you . $msg .'</p>
    </div>
    </div>
    </a>';
}

?>