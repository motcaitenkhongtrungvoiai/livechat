<?php
session_start();
?>
<?php
include_once ("php/config.php");
include_once ('header.php');
if (!isset($_SESSION['unique_id'])) {
    header("location: login.php");
}
?>

<body>

    <div class="wrapper">
        <div>
            <section class="users">
                <header>
                    <div class="content">
                        <?php
                        $sql = mysqli_query($conn, "select * from `users` where `unique_id` = '{$_SESSION['unique_id']}'");

                        if (mysqli_num_rows($sql) > 0) {
                            $row = mysqli_fetch_assoc($sql);
                        }

                        ?>
                        <img src="php/img/<?php echo $row['img']; ?>" >
                        <div class="details">
                            <span> <?php echo $row['fname'] . " " . $row['lname']; ?></span>
                            <p><?php echo $row['status'] ?></p>
                        </div>
                    </div>
                    <a href="php/logout.php?logout_id=<?php echo $row['unique_id']; ?>" class="logout">logout</a>
                </header>
               <form  method="post">
                    <div class="search">
                        <span class="text">chọn người để chat</span>
                        <input type="text" placeholder="nhấn tên người chat" name ="searchTerm">
                        <button><span class="material-symbols-outlined"></span></button>                       
                    </div>
              </form>
                <div class="users-list"> </div>
            </section>
        </div>
    </div>
    <script type="text/javascript" src="js/users.js?v=<?php echo time(); ?>"></script>

</body>