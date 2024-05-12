<?php
session_start();
if (isset($_SESSION['unique_id'])) {
  header("location: users.php");
}
require_once "header.php";
?>

<body>
  <div class="wrapper">
    <section class="form login">
      <header>Text Me</header>
      <form action="#" autocomplete="off">
        <div class="error-txt"></div>
        <div class="field input">
          <label for="">Email</label>
          <input type="email" name="email" placeholder="Enter your email" required />
        </div>
        <div class="field input">
          <label for="">Password</label>
          <input type="password" name="password" placeholder="Enter your password" required />
          <i class="fas fa-eye"></i>
        </div>
        <div class="field button">
          <input type="submit" value="SignUp" />
        </div>
      </form>
      <div class="link">Not yet signed up? <a href="index.php">Signup now</a></div>
    </section>
  </div>
  <script src="js/password-show-hide.js"></script>
  <script src="ajax/login.js"></script>
</body>

</html>