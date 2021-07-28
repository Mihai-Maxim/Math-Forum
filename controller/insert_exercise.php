<?php
include_once('../model/exerciseManip.php');
include_once('../model/logsManip.php');
include_once('../model/blacklistManip.php');
echo '<a  target="_parent" id="Redirect" style="display: none" href="/~mihai.maxim/controller/exercises_xml.php?e=&noRedirect=true&Special=true">Back</a>';
if(isset($_POST['CreateExerciseSubmit']))
{
    $exercises=new exerciseManip();
    if(((isset($_SESSION['Username']))&&(empty($_POST['CreateExerciseRequestAnon']))))
    {   $blocked=new blacklistManip();
        $block=$blocked->checkBlock($_SESSION['Username']);
        if($block[0][0]==0){
        $logs=new logsManip();
        $logs->insertLog($_SESSION['Username'],$_POST['CreateExerciseRequestTitle'],7);
        $exercises->insertExercise($_SESSION['Username'],$_POST['CreateExerciseRequestTitle'],$_POST['CreateExerciseRequestCategory'],$_POST['CreateExerciseRequestComments']);

        ?>
        <script>
            document.getElementById('Redirect').click();
        </script>
  <?php
        }else
        {
            ?>
            <script>
                alert('You have been blacklisted by an admin,you cannot post!');
            </script>
            <?php
        }
    }

}