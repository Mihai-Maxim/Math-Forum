<?php
$threadView='view/NewThread.php';
$loginView='view/Login.php';
$registerView='view/Register.php';
$exerciseView='view/NewExercise.php';
session_start();
if(isset($_SESSION['Username']))
{
    $loginView='view/AlreadyLoggedIn.php';
}else
    $loginView='view/Login.php';

echo '<div class="Container" id="newThread">';
include ($threadView);
echo '</div>';

echo '<div class="Container" id="Login">';
include ($loginView);
echo '</div>';

echo ' <div class="Container" id="Register" >';
include ($registerView);
echo '</div>';

echo '<div class="Container" id="newExercise">';
include ($exerciseView);
echo '</div>';

