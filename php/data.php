<?php
// Prepare an array to store the user messages
$userMessages = [];

// Fetch all unique_ids from $query result set
$uniqueIds = [];
while ($row = mysqli_fetch_assoc($query)) {
    $uniqueIds[] = $row['unique_id'];
}

// Create a single SQL query to fetch all latest messages for these unique_ids
if (!empty($uniqueIds)) {
    $uniqueIdsString = implode("','", $uniqueIds);
    $sql2 = "
        SELECT * FROM `messenger`
        WHERE `incoming_msg_id` IN ('$uniqueIdsString') 
           OR `outgoing_msg_id` IN ('$uniqueIdsString')
        ORDER BY `id_msg` DESC
    ";

    $query2 = mysqli_query($conn, $sql2);

    // Store the latest message for each user in an associative array
    while ($row2 = mysqli_fetch_assoc($query2)) {
        if (
            !isset($userMessages[$row2['incoming_msg_id']]) ||
            !isset($userMessages[$row2['outgoing_msg_id']])
        ) {
            $userMessages[$row2['incoming_msg_id']] = $row2;
            $userMessages[$row2['outgoing_msg_id']] = $row2;
        }
    }
}

// Reset the result set to loop again through the users
mysqli_data_seek($query, 0);

while ($row = mysqli_fetch_assoc($query)) {
    $uniqueId = $row['unique_id'];
    $result = "không có tin nhắn nào";

    if (isset($userMessages[$uniqueId])) {
        $result = $userMessages[$uniqueId]['msg'];
    }

    // Trim the message if it's too long
    $msg = (strlen($result) > 28) ? substr($result, 0, 28) . '...' : $result;

    // Determine if the current message is sent by the current user
    $you = (isset($userMessages[$uniqueId]) && $userMessages[$uniqueId]['outgoing_msg_id'] == $outgoing_id) ? "You: " : "";

    // Determine offline status
 ($row['status'] == "offline now") ? $offline="offline": $offline="";

    // Hide current user from the list
    $hid_me = ($outgoing_id == $uniqueId) ? "hide" : "";

    // Create the output HTML
    $output .= '<a href="chat.php?user_id=' . $uniqueId . ' ">
        <div class="content ' . $hid_me . '">
            <img src="php/img/' . htmlspecialchars($row['img']) . '" alt="User Image">
            <div class="details">
                <span>' . htmlspecialchars($row['fname'] . " " . $row['lname']) . '</span>
                <p>' . $you . htmlspecialchars($msg) . '</p>
            </div>
        </div>
        <div class="status-dot ' . $offline . '">
            <span class="material-symbols-outlined">pending</span>
        </div>
    </a>';
}
