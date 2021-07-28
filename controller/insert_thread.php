<?php
session_start();
include_once('model/threadManip.php');
include_once('model/exerciseManip.php');
include_once ('model/logsManip.php');
include_once ('model/blacklistManip.php');
if(isset($_POST['CreateThreadSubmit']))
{
  $logs=new logsManip();
  $threads=new threadManip();
  if(((isset($_SESSION['Username']))&&(empty($_POST['CreateThreadRequestAnon']))))
  {   $blocked=new blacklistManip();
      $block=$blocked->checkBlock($_SESSION['Username']);
      if($block[0][0]==0){
      $threads->insertThread($_SESSION['Username'],$_POST['CreateThreadRequestTitle'],$_POST['CreateThreadRequestCategory'],$_POST['CreateThreadRequestComments']);
      $logs->insertLog($_SESSION['Username'],$_POST['CreateThreadRequestTitle'],1);
      }


  }
  else
  {$threads->insertThread($_SESSION['Anon'],$_POST['CreateThreadRequestTitle'],$_POST['CreateThreadRequestCategory'],$_POST['CreateThreadRequestComments']);
      $logs->insertLog($_SESSION['Anon'],$_POST['CreateThreadRequestTitle'],1);
  }
   if(isset($_SESSION['Username']))
   {
   $blocked=new blacklistManip();
   $block=$blocked->checkBlock($_SESSION['Username']);
   if($block[0][0]==0){
   sleep(1);
   header("Location: home.php?t=".$_POST['CreateThreadRequestTitle']);}
   else
   {
       ?>
          <script>
              alert('You have been blacklisted by an admin,you cannot post!');
          </script>
<?php
   }

   }
   else
   {
       sleep(1);
       header("Location: home.php?t=".$_POST['CreateThreadRequestTitle']);
   }

}





?>