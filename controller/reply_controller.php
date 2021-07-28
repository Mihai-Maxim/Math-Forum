<?php

include_once('/fenrir/studs/mihai.maxim/html/model/replyManip.php');
include_once('/fenrir/studs/mihai.maxim/html/model/usersManip.php');
include_once('/fenrir/studs/mihai.maxim/html/model/threadManip.php');
include_once('/fenrir/studs/mihai.maxim/html/model/exerciseManip.php');
include_once('/fenrir/studs/mihai.maxim/html/model/exerciseReplyManip.php');
include_once('/fenrir/studs/mihai.maxim/html/model/logsManip.php');
include_once ('check_if_blacklist.php');
session_start();
if(isset($_POST['CreateReplySubmit']))
{
    if((!empty($_POST['CreateReplyRequestText']))&&(!empty($_FILES['CreateReplyRequestFile'])))
{       $logs=new logsManip();
        $users=new usersManip();
        $user=$users->getUser($_SESSION['Username']);
        $replies=new replyManip();
        if(isset($_FILES['CreateReplyRequestFile']))
        {

            $threads=new threadManip();
            if(isset($_SESSION['Username']))
            {$rows=$threads->getThreadIdByUser($_SESSION['Username']);
                $ID=$rows[0];}
            else
            {$rows=$threads->getThreadIdByUser($_SESSION['Anon']);
            $ID=$rows[0];}


            $file=$_FILES['CreateReplyRequestFile'];
            $name=$_FILES['CreateReplyRequestFile']['name'];
            $fileTmp=$_FILES['CreateReplyRequestFile']['tmp_name'];
            $size=$_FILES['CreateReplyRequestFile']['size'];
            $error=$_FILES['CreateReplyRequestFile']['error'];
            $type=$_FILES['CreateReplyRequestFile']['type'];
            $filext=explode('.',$name);
            $filextlow=strtolower(end($filext));
            $allowed=array('jpg','jpeg','png','pdf','docx','txt','doc','xsl','slt','xla','ppt','pptx','svg');

            if(in_array($filextlow,$allowed))
            {
                if($error===0){
                    if($size<1000000)
                    {
                        $filenew=uniqid('',true).".".$filextlow;
                        $destination='/fenrir/studs/mihai.maxim/html/view/images/'.$filenew;
                        move_uploaded_file($fileTmp,$destination);
                        if(isset($_SESSION['Username'])) {
                            if(!isBlacklisted($_SESSION['Username'])){
                            $title=$users->getTitleById($_POST['CreateReplySubmit']);
                            $logs->insertLog($_SESSION['Username'],$title[0]['Title'],2);
                            $replies->insertReply($user['ID'], $_POST['CreateReplySubmit'], $_POST['CreateReplyRequestText'], $filenew);
                            $relevance=$threads->getRelevance( $_POST['CreateReplySubmit']);
                            $threads->setRelevance( $_POST['CreateReplySubmit'],$relevance[0][0]);}

                        }
                        else {
                            $title=$users->getTitleById($_POST['CreateReplySubmit']);
                            $logs->insertLog($_SESSION['Anon'],$title[0]['Title'],2);
                            $replies->insertReplyAnon(0, $_POST['CreateReplySubmit'], $_POST['CreateReplyRequestText'], $filenew, $_SESSION['Anon']);
                            $relevance=$threads->getRelevance( $_POST['CreateReplySubmit']);
                            $threads->setRelevance( $_POST['CreateReplySubmit'],$relevance[0][0]);
                        }





                    }
                    else
                    {  ?>
                        <script>
                            alert("File too big!");
                        </script>
                        <?php
                    }
                }
                else
                {   ?>
                    <script>
                        alert("Upload failed!");
                    </script>
                    <?php
                }

            }
            else
            {  if(isset($_SESSION['Username']))
            {$rows=$threads->getThreadIdByUser($_SESSION['Username']);
                $ID=$rows[0];}
            else
            {$rows=$threads->getThreadIdByUser($_SESSION['Anon']);
                $ID=$rows[0];}
                if(isset($_SESSION['Username'])) {
                    if(!isBlacklisted($_SESSION['Username'])){
                    $title=$users->getTitleById($_POST['CreateReplySubmit']);
                    $logs->insertLog($_SESSION['Username'],$title[0]['Title'],2);
                    $replies->insertReply($user['ID'], $_POST['CreateReplySubmit'], $_POST['CreateReplyRequestText'], "");
                    $relevance=$threads->getRelevance( $_POST['CreateReplySubmit']);
                    $threads->setRelevance( $_POST['CreateReplySubmit'],$relevance[0][0]);}
                }
                else {
                    $title=$users->getTitleById($_POST['CreateReplySubmit']);
                    $logs->insertLog($_SESSION['Anon'],$title[0]['Title'],2);
                    $replies->insertReplyAnon(0, $_POST['CreateReplySubmit'], $_POST['CreateReplyRequestText'], "", $_SESSION['Anon']);
                    $relevance=$threads->getRelevance( $_POST['CreateReplySubmit']);
                    $threads->setRelevance( $_POST['CreateReplySubmit'],$relevance[0][0]);
                }



            }
            $title=$users->getTitleById($_POST['CreateReplySubmit']);
            header("Location: ../home.php?t=".$title[0]['Title'].'&'.'isReply=true');
        }
}
    else
{?>
    <script>
        alert(" Text required!");
    </script>
    <?php
    $users=new usersManip();
    $title=$users->getTitleById($_POST['CreateReplySubmit']);

    header("Location: ../home.php?t=".$title[0]['Title'].'&'.'isReply=true');

}

}





