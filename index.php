<?php session_start(); 
if(isset($_SESSION['unique_id'])){
    header("location: user.php");
}
?>

<?php include_once "header.php"; ?>

<body>
    <div class="wrapper">

        <section class="form signup">
            <header>Real time Chat</header>
            <form action="#" method="post" enctype="multipart/form-data" autocomplete="off">
                <div class="error-text"></div>
                <div class="name-details">
                    <div class="field input">
                        <label>First name</label>
                        <input type="text" name="fname" placeholder="first name" required>
                    </div>
                    <div class="field input">
                        <label>last name</label>
                        <input type="text" name="lname" placeholder="last name" required>
                    </div>
                </div>
                <div class="field input">
                    <label> email Address</label>
                    <input type="email" name="email" placeholder="enter you email" required>
                </div>
                <div class="field input">
                    <label>password</label>
                    <input type="text" name="password" placeholder="enter you new pass" required>
                </div>
                <div class="field image">
                    <label>Profile Image</label>
                    <input type="file" name="image">
                </div>
                <div class="field button">
                    <input type="submit" name="submit" value="Contine to Chat">
                </div>

            </form>
            <div class="link">Already signup? <a href="login.php"> Login now!</a></div>
        </section>
    </div>

</body>
<script type="text/javascript" src="js/signup.js?v=<?php echo time();?>"></script>

</html>