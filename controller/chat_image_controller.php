<?php
session_start();
include_once('/fenrir/studs/mihai.maxim/html/model/chatManip.php');


include_once('/fenrir/studs/mihai.maxim/html/model/chatImageManip.php');

ini_set('display_errors', 1);

if(isset($_FILES['CreateChatRequestFile'])&&((!empty($_POST['Message']))&&((strlen(trim($_POST['Message'])) != 0))))
{

    $images=new chatImageManip();
    $messages=new chatManip();
    if(isset($_SESSION['Username']))
    $rows=$messages->getMessageIdByUser($_SESSION['Username']);
    else
        $rows=$messages->getMessageIdByUser($_SESSION['Anon']);

    $ID=$rows[0]['ID'];
    $file=$_FILES['CreateChatRequestFile'];
    $name=$_FILES['CreateChatRequestFile']['name'];
    $fileTmp=$_FILES['CreateChatRequestFile']['tmp_name'];
    $size=$_FILES['CreateChatRequestFile']['size'];
    $error=$_FILES['CreateChatRequestFile']['error'];
    $type=$_FILES['CreateChatRequestFile']['type'];
    $filext=explode('.',$name);
    $filextlow=strtolower(end($filext));
    $allowed=array('jpg','jpeg','png','pdf','docx','txt','doc','xsl','slt','xla','ppt','pptx','svg');

    if(in_array($filextlow,$allowed))
    {
        if($error===0){
         if($size<100000000)
         {

          $filenew=uniqid('',true).".".$filextlow;
          $destination='view/images/'.$filenew;
          move_uploaded_file($fileTmp,$destination);
          $images->insertImageToChat($ID,$filenew);

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
            alert("Image upload failed!");
            </script>
            <?php
        }

    }

}




?>
