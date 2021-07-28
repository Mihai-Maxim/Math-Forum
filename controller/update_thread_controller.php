<?php
session_start();
include('/fenrir/studs/mihai.maxim/html/model/usersManip.php');
include_once ('/fenrir/studs/mihai.maxim/html/model/logsManip.php');


if(isset($_GET['UpdateThread']))
{

    $users=new usersManip();
    $logs=new logsManip();
    $title=$users->getTitleById($_GET['UpdateThread']);
    if(isset($_SESSION['IsAdmin']))
    $logs->insertLog('(Admin)'.$_SESSION['Username'],$title[0]['Title'],4);
    else
        $logs->insertLog($_SESSION['Username'],$title[0]['Title'],4);

    $users=new usersManip();
    $users->updateThreadContentById($_GET['UpdateThread'],"UPDATED:".$_GET['PostText']);
    $title=$users->getTitleById($_GET['UpdateThread']);
    sleep(3);
    header("Location: ../home.php?t=".$title[0]['Title']);


}