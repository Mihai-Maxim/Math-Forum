<?php
session_start();
include_once('model/threadManip.php');


include_once('model/imageManip.php');

ini_set('display_errors', 1);

if(isset($_FILES['CreateThreadRequestFile']))
{  
    $images=new imageManip();
    $threads=new threadManip();
    if(isset($_SESSION['Username'])){
    if(!empty($_POST['CreateThreadRequestAnon']))
    {
        $rows=$threads->getThreadIdByUser($_SESSION['Anon']);
    }
    else
        $rows=$threads->getThreadIdByUser($_SESSION['Username']);
    }
    else
        $rows=$threads->getThreadIdByUser($_SESSION['Anon']);

    $ID=$rows[0]['ID'];
    $file=$_FILES['CreateThreadRequestFile'];
    $name=$_FILES['CreateThreadRequestFile']['name'];
    $fileTmp=$_FILES['CreateThreadRequestFile']['tmp_name'];
    $size=$_FILES['CreateThreadRequestFile']['size'];
    $error=$_FILES['CreateThreadRequestFile']['error'];
    $type=$_FILES['CreateThreadRequestFile']['type'];
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
          $images->insertImageToThread($ID,$filenew);

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
