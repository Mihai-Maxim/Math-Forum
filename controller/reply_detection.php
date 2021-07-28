<?php
include_once('/fenrir/studs/mihai.maxim/html/model/replyManip.php');
include_once('/fenrir/studs/mihai.maxim/html/model/threadManip.php');
session_start();
if($_SESSION['NewReplies']!='')
{
    $replies=new replyManip();
    $threads=new threadManip();
    $threadId=$threads->getThreadByTitle($_SESSION['NewReplies']);
    $replyCount=$replies->getRepliesByThreadId($threadId[0]['ID']);

    if($_SESSION['NewRepliesCount']<$replyCount[0][0])
    {
       echo "<a href='home.php?t=".$_SESSION['NewReplies']."'".">New replies</a>";
    }
    else
    {
        echo "";
    }


}