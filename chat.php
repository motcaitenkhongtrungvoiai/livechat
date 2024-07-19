<?php
session_start();
include_once "header.php";
?>

<body>
    <div class="wrapper">
        <section class="chat-area">
            <header><a href="user.php" class="black-icon"><span class="material-symbols-outlined">out</span></a>
                <img src="php/img//1721310702download.jpg" alt="">
                <div class="details">
                    <span>
                        Frist Last
                    </span>
                    <p>Online</p>
                </div>
            </header>

            <div class="chat-box">

            </div>
            <form action="#" class="typing-area">
                <input type="text" class="incoming_id" name="incoming_id" value="" hidden>
                <input type="text" name="message" class="input-field" placeholder="gõ tin nhắn ở đây" autocomplete="off">
                <button><span class="material-symbols-outlined">send</span></button>
            </form>

        </section>
    </div>
</body>

</html>