<?php

session_start();
session_destroy();
//session_unset($_SESSION[user_id]);

echo "<script> location.replace('login.php');</script>";

?>
