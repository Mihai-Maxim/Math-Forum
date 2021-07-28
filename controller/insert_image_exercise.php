<?php
session_start();
include_once ('../model/exerciseImageManip.php');
include_once ('../model/exerciseManip.php');
if(isset($_FILES['CreateExerciseRequestFile']))
{
    $images=new exerciseImageManip();
    $exercises=new exerciseManip();
    if(isset($_SESSION['Username']))
        $rows=$exercises->getExerciseIdByUser($_SESSION['Username']);
    else
        $rows=$exercises->getExerciseIdByUser($_SESSION['Anon']);

    $ID=$rows[0]['ID'];
    $file=$_FILES['CreateExerciseRequestFile'];
    $name=$_FILES['CreateExerciseRequestFile']['name'];
    $fileTmp=$_FILES['CreateExerciseRequestFile']['tmp_name'];
    $size=$_FILES['CreateExerciseRequestFile']['size'];
    $error=$_FILES['CreateExerciseRequestFile']['error'];
    $type=$_FILES['CreateExerciseRequestFile']['type'];
    $filext=explode('.',$name);
    $filextlow=strtolower(end($filext));
    $allowed=array('jpg','jpeg','png','pdf','docx','txt','doc','xsl','slt','xla','ppt','pptx','svg');

    if(in_array($filextlow,$allowed))
    {
        if($error===0){
            if($size<100000000)
            {

                $filenew=uniqid('',true).".".$filextlow;
                $destination='../view/images/'.$filenew;
                move_uploaded_file($fileTmp,$destination);
                $images->insertImageToExercise($ID,$filenew);

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