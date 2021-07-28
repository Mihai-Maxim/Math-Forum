<?php
include_once('/fenrir/studs/mihai.maxim/public_html/model/replyManipUser.php');
include_once('/fenrir/studs/mihai.maxim/public_html/model/threadManip.php');
include_once('/fenrir/studs/mihai.maxim/public_html/model/logsManip.php');
session_start();
if(isset($_POST['DeleteReply'])&&((isset($_SESSION['Username']))||(isset($_SESSION['IsAdmin']))))
{


    $replies=new replyManipUser();
    $title=$replies->getThreadTitleByReplyId($_POST['DeleteReply']);
    $threadID=$replies->getThreadIdByReplyId($_POST['DeleteReply']);
    $relevance=$replies->getRelevance($threadID[0][0]);
    $replies->setRelevance($threadID[0][0],$relevance[0]);
    $replies->deleteReplyById($_POST['DeleteReply']);

    $users=new threadManip();
    $logs=new logsManip();
    $title=$users->getTitleById($threadID[0][0]);
    if(isset($_SESSION['IsAdmin']))
        $logs->insertLog('(Admin)'.$_SESSION['Username'],$title[0]['Title'],5);
    else
        $logs->insertLog($_SESSION['Username'],$title[0]['Title'],5);


    header("Location: ../home.php?t=".$title[0]['Title']);

}
if(isset($_POST['UpdateReply'])&&((isset($_SESSION['Username']))||(isset($_SESSION['IsAdmin']))))
{
    $message=$_POST['ReplyRequestText'];
    $replies=new replyManipUser();
    $title=$replies->getThreadTitleByReplyId($_POST['UpdateReply']);
    $replies->updateReplyById($_POST['UpdateReply'],'UPDATED:'.$message);

    $logs=new logsManip();
    if(isset($_SESSION['IsAdmin']))
    $logs->insertLog('(Admin)'.$_SESSION['Username'],$title[0]['Title'],6);
    else
        $logs->insertLog($_SESSION['Username'],$title[0]['Title'],6);


    header("Location: ../home.php?t=".$title[0]['Title']);
}
