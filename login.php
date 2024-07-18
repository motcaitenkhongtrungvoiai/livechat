<?php session_start(); 
if(isset($_SESSION['unique_id'])){
    header("location: user.php");
}
?>
<?php include_once "header.php"; ?>

<body>

    <div class="wrapper">
        <section class="form login">
            <header>
                Realtime chat app
            </header>
            <form action="#" method="POST" enctype="multipart/form-data" autocomplete="off">
                <div class="error-text"></div>
                <div class="field input">
                    <label for=""> email Address</label>
                    <input type="email" name="email" placeholder="enter you email" required>
                </div>
                <div class="field input">
                    <label for="">password</label>
                    <input type="password" name="password" placeholder="enter you password" id="">
                    <i class="fas fa-eye"></i>
                </div>
                <div class="field button">
                    <input type="button" name="submit" value="Contine to Chat">
                </div>

            </form>
            <div class="link">not yet signed up?<a href="index.php"> Register now!</a></div>
        </section>
    </div>
    <script type="text/javascript" src="js/login.js?v=<?php echo time(); ?>"></script>

</body>