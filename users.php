<?php
session_start();
if(!isset($_SESSION['unique_id'])) {
  header("location: login.php");
}
require_once "header.php";
?>

<body>
  <div class="wrapper">
    <section class="users">
      <header>
        <?php
        include_once "php/config.php";
        $fetchLoginUserDataQuery = mysqli_query($conn, "SELECT unique_id, fname, lname, img, status FROM users WHERE unique_id = {$_SESSION['unique_id']}");
        if(mysqli_num_rows($fetchLoginUserDataQuery)) {
          $row = mysqli_fetch_assoc($fetchLoginUserDataQuery);
        }
        ?>
        <div class="content">
          <img src="images/<?= $row['img']; ?>" alt="No Img Found" />
          <div class="details">
            <span><?= $row['fname'] . " " . $row['lname']; ?></span>
            <p><?= $row['status']; ?></p>
          </div>
        </div>
        <a href="php/logout.php?logout_id=<?= $row['unique_id']; ?>" class="logout">Logout</a>
      </header>
      <div class="search">
        <span class="text">Select user to start chat</span>
        <input type="text" placeholder="Enter name to search..." />
        <button><i class="fas fa-search"></i></button>
      </div>
      <div class="users-list">

      </div>
    </section>
  </div>
  <script src="js/search-bar.js"></script>
  <script src="ajax/search.js"></script>
  <script src="ajax/user.js"></script>
</body>

</html>