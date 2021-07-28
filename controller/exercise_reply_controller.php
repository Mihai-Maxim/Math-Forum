<?php
include_once('/fenrir/studs/mihai.maxim/html/model/replyManip.php');
include_once('/fenrir/studs/mihai.maxim/html/model/usersManip.php');
include_once('/fenrir/studs/mihai.maxim/html/model/threadManip.php');
include_once('/fenrir/studs/mihai.maxim/html/model/exerciseManip.php');
include_once('/fenrir/studs/mihai.maxim/html/model/exerciseReplyManip.php');
include_once('/fenrir/studs/mihai.maxim/html/model/logsManip.php');
include_once ('check_if_blacklist.php');
session_start();

if(isset($_POST['CreateExerciseReplySubmit']))
{
    if((!empty($_POST['CreateExerciseReplyRequestText']))&&(!empty($_FILES['CreateExerciseReplyRequestFile'])))
    {

        $logs=new logsManip();


        $users=new usersManip();
        $user=$users->getUser($_SESSION['Username']);


        $replies=new exerciseReplyManip();
        if(isset($_FILES['CreateExerciseReplyRequestFile']))
        {

            $exercises=new exerciseManip();
            if(isset($_SESSION['Username']))
            {$rows=$exercises->getExerciseIdByUser($_SESSION['Username']);
                $ID=$rows[0];}
            else
            {$rows=$exercises->getExerciseIdByUser($_SESSION['Anon']);
                $ID=$rows[0];}


            $file=$_FILES['CreateExerciseReplyRequestFile'];
            $name=$_FILES['CreateExerciseReplyRequestFile']['name'];
            $fileTmp=$_FILES['CreateExerciseReplyRequestFile']['tmp_name'];
            $size=$_FILES['CreateExerciseReplyRequestFile']['size'];
            $error=$_FILES['CreateExerciseReplyRequestFile']['error'];
            $type=$_FILES['CreateExerciseReplyRequestFile']['type'];
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
                            $title=$exercises->getTitleById($rows[0][0]);
                            $logs->insertLog($_SESSION['Username'],$title[0][0],10);
                            $replies->insertExerciseReply($user['ID'], $_POST['CreateExerciseReplySubmit'], $_POST['CreateExerciseReplyRequestText'], $filenew);
                            $relevance=$exercises->getRelevance( $_POST['CreateExerciseReplySubmit']);
                            $exercises->setRelevance( $_POST['CreateExerciseReplySubmit'],$relevance[0][0]);}
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
            {$rows=$exercises->getExerciseIdByUser($_SESSION['Username']);
                $ID=$rows[0];}
            else
            {$rows=$exercises->getExerciseIdByUser($_SESSION['Anon']);
                $ID=$rows[0];}
                if(isset($_SESSION['Username'])) {
                    if(!isBlacklisted($_SESSION['Username'])){
                    $title=$exercises->getTitleById($rows[0][0]);

                    $logs->insertLog($_SESSION['Username'],$title[0][0],10);

                    $replies->insertExerciseReply($user['ID'], $_POST['CreateExerciseReplySubmit'], $_POST['CreateExerciseReplyRequestText'], "");
                    $relevance=$exercises->getRelevance( $_POST['CreateExerciseReplySubmit']);
                    $exercises->setRelevance( $_POST['CreateExerciseReplySubmit'],$relevance[0][0]);}
                }


            }

        }
    }
    else
    {?>
        <script>
            alert(" Text required!");
        </script>
        <?php

    }






}
