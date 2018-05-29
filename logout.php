<?php
  session_start();
  session_destroy();
  unset($_SESSION['user']);
  header("location: login.php");
?>
