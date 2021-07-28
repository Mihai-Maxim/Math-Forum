<?php
session_start();
$user=$_SESSION['Username'];
echo' <h1 style="text-align: center; color: green;padding-top:-5px;">You are logged as:'.$user.'!</h1>';
echo '<h2 style="text-align: center"><a href="controller/log_out.php" style="color: black">Log out</a></h2>';
