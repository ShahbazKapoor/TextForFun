<?php
session_start();
if (!isset($_SESSION['unique_id'])) {
    header("location: login.php");
}
require_once "header.php";
?>

<body>
    <div class="wrapper">
        <section class="chat-area">
            <header>
                <?php
                include_once "php/config.php";
                $userId = mysqli_real_escape_string($conn, $_GET['user_id']);
                $fetchLoginUserDataQuery = mysqli_query($conn, "SELECT fname, lname, img, status FROM users WHERE unique_id = {$userId}");
                if (mysqli_num_rows($fetchLoginUserDataQuery)) {
                    $row = mysqli_fetch_assoc($fetchLoginUserDataQuery);
                }
                ?>
                <a href="users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
                <img src="images/<?= $row['img']; ?>" alt="">
                <div class="details">
                    <span><?= $row['fname'] . " " . $row['lname']; ?></span>
                    <p><?= $row['status']; ?></p>
                </div>
            </header>
            <div class="chat-box">

            </div>
            <form action="#" class="typing-area" autocomplete="off">
                <input type="text" name="outgoing_id" value="<?= $_SESSION['unique_id']; ?>" hidden />
                <input type="text" name="incoming_id" value="<?= $userId; ?>" hidden /> 
                <input type="text" class="input-field" name="message" placeholder="Message">
                <button><i class="fab fa-telegram-plane"></i></button>
            </form>
        </section>
    </div>
    <script src="ajax/chat.js"></script>
</body>

</html>