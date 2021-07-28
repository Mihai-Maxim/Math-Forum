<?php
session_start();
include_once('/fenrir/studs/mihai.maxim/html/model/threadManip.php');
include_once ('/fenrir/studs/mihai.maxim/html/model/logsManip.php');
if(isset($_GET['DeleteThread'])&&(isset($_SESSION['Username'])||(isset($_SESSION['IsAdmin']))))
{
    $users=new threadManip();
    $logs=new logsManip();
    $title=$users->getTitleById($_GET['DeleteThread']);
    if(isset($_SESSION['IsAdmin']))
    $logs->insertLog('(Admin)'.$_SESSION['Username'],$title[0]['Title'],3);
    else
        $logs->insertLog($_SESSION['Username'],$title[0]['Title'],3);

    $threads=new threadManip();
    $threads->deleteThreadById($_GET['DeleteThread']);
    ?>
    <script type="text/javascript">
        alert("Thread deleted!");
        location="../home.php?t=";

    </script>
    <?php


}