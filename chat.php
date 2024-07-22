<?php
session_start();
include_once "header.php";
include_once "php/config.php";
if (!isset($_SESSION['unique_id'])) {
    header("location : login.php");
}
?>

<body>
    <div class="wrapper">
        <section class="chat-area">
            <header>
                <?php
                $user_id = mysqli_real_escape_string($conn, $_GET['user_id']);
                $sql = mysqli_query($conn, "select * from `users` where `unique_id` ='{$user_id}' ");
                if (mysqli_num_rows($sql) > 0) {
                    $row = mysqli_fetch_assoc($sql);
                } else {
                    header("location:user.php");
                }

                ?>
                <a href="user.php" class="black-icon"><span class="material-symbols-outlined">arrow_back</span></a>
                <img src="php/img/<?php echo $row['img']; ?>" alt="">
                <div class="details">
                    <span>
                       <?php echo $row['fname'] ." ".$row['lname'];?>
                    </span>
                    <p><?php echo $row['status'] ?></p>
                </div>
            </header>

            <div class="chat-box">

            </div>
            <form action="#" class="typing-area">
                <input type="text" class="incoming_id" name="incoming__id" value="<?php echo $user_id ?>" hidden>
                <input type="text" name="message" class="input-field" placeholder="gõ tin nhắn ở đây"
                    autocomplete="off">
                <button><span class="material-symbols-outlined">send</span></button>
            </form>

        </section>
    </div>
</body>

</html>