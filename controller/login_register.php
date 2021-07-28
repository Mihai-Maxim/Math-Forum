<?php
include('model/usersManip.php');
include('model/threadManip.php');
include ('model/adminsManip.php');
session_start();
if(isset($_POST['RegisterRequest']))
{ 
  $users=new usersManip();
  $numOfUsers= $users->verifyUser($_POST['RegisterRequestUsername']);
  $numOfEmails=$users->verifyUserEmail($_POST['RegisterRequestEmail']);
  if($numOfEmails[0]==1)
  {
      ?>
      <script>
          alert("An account is already associated with this email!");
      </script>
      <?php
  }
  else
  if($numOfUsers[0]==0)
  {


      if (!filter_var($_POST['RegisterRequestEmail'], FILTER_VALIDATE_EMAIL)) {
          ?>
          <script>
              alert("Email format is invalid!");
          </script>
          <?php
      }
      else
          if(preg_match('/^[a-zA-Z0-9]{5,}$/', $_POST['RegisterRequestUsername'])) {
              $saltedPass=$_POST['RegisterRequestUsername'][strlen($_POST['RegisterRequestUsername'])-1].$_POST['RegisterRequestPassword'].$_POST['RegisterRequestUsername'][0];

              $users->insertUser($_POST['RegisterRequestUsername'],sha1($saltedPass),$_POST['RegisterRequestEmail']);
              ?>
              <script>
                  alert("Account created,you may now login!");
              </script>
              <?php
          }
          else
          {
              ?>
              <script>
                  alert("Wrong username format:letters and numbers only,min length=5 characters!");
              </script>
              <?php
          }

  }
  else
  {
    ?>
    <script>
    alert("Account already exists!");
    </script>
    <?php
  }
    unset($GLOBALS['RegisterRequest']);

}

if(isset($_POST['LoginRequest']))
{  
  $users=new usersManip();
    $saltedPass=$_POST['LoginRequestUsername'][strlen($_POST['LoginRequestUsername'])-1].$_POST['LoginRequestPassword'].$_POST['LoginRequestUsername'][0];
  $numOfUsers= $users->verifyUserLogin($_POST['LoginRequestUsername'],sha1($saltedPass));

  if($numOfUsers[0]==1)
  { 
   $_SESSION['LoggedStatus']='LoggedIn';
   $_SESSION['Username']=$_POST['LoginRequestUsername'];
   $admins=new adminsManip();
   $admin=$admins->checkAdmin($_SESSION['Username']);
   if($admin[0][0]!=0)
   {
       $_SESSION['IsAdmin']='true';
   }


   ?>
   <script>
   alert("You are now logged in!");
   </script>
   <?php
  }
  else
  {
      ?>
      <script>
          alert("Wrong username/password!");
      </script>
      <?php
  }

}
?>