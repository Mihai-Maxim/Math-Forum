<?php
session_start();
include_once ('../model/usersManip.php');
include_once ('../model/adminsManip.php');
include_once ('../model/blacklistManip.php');
include_once ('../model/chatManip.php');
include_once ('../model/chatImageManip.php');
include ('check_if_admin.php');

if(isset($_SESSION['IsAdmin']))
{
    $users=new usersManip();
    $admins=new adminsManip();
    $blocks=new blacklistManip();
    $chat=new chatManip();
    $chatImage=new chatImageManip();
    echo '
    <form method="post">
    <input name="AddAdminText" type="text" style="width: 60%; border-radius: 10px;">
    <br>
    <button name="AddAdmin">Add Admin</button>';
    echo '<br><br>';
    if($_SESSION['Username']=='mihaimaxim')
        echo '
        <input name="RemoveAdminText" type="text" style="width:60%; border-radius: 10px;">
         <br>
        <button  name="RemoveAdmin">Remove Admin</button>
        <br><br>
        ';
    echo '<input name="BlockUserText" type="text" style="width: 60%; border-radius: 10px;">
          <br>
         <button name="BlockUser">Block User</button>
         ';
    echo '<br><br>';

    echo '<input name="UnblockUserText" type="text" style="width: 60%; border-radius: 10px;">
          <br>
         <button name="UnblockUser">Unblock User</button>
         ';
    echo '<br><br>';
    echo '<input name="DeleteChatMessagesText" type="text" style="width: 60%; border-radius: 10px;">
          <br>
         <button name="DeleteChatMessages">Delete Messages</button>
         ';
    echo '
    </form>
    ';

    if(isset($_POST['AddAdmin']))
    {
        $user=$users->verifyUser($_POST['AddAdminText']);
        if($user[0][0]!=0)
        {
            $admin=$admins->checkAdmin($_POST['AddAdminText']);
            if($admin[0][0]==0)
            {
                if($_POST['AddAdminText']==$_SESSION['Username'])
                {
                    ?>
                    <script>
                        alert("You cannot add yourself!");
                    </script>
                    <?php
                }
                else{
                    $block=$blocks->checkBlock($_POST['AddAdminText']);
                    if($block[0][0]==0){
                ?>
                 <script>
                     alert("Succes!");
                 </script>
                <?php
                $admins->insertAdmin($_POST['AddAdminText']);}
                else
                {
                    ?>
                    <script>
                        alert("The user is blocked!");
                    </script>
                    <?php
                }

                }
            }
            else
            {

                ?>
                <script>
                    alert("Admin already exists!");
                </script>
                <?php
            }
        }
        else
        {
            ?>
            <script>
                alert("User does not exist!");
            </script>
            <?php
        }
    }
    if(isset($_POST['RemoveAdmin']))
    {
        $user=$users->verifyUser($_POST['RemoveAdminText']);
        if($user[0][0]!=0)
        {
            $admin=$admins->checkAdmin($_POST['RemoveAdminText']);
            if($admin[0][0]!=0)
            {
                if($_POST['RemoveAdminText']==$_SESSION['Username'])
                {
                    ?>
                    <script>
                        alert("You cannot remove yourself!");
                    </script>
                    <?php
                }
                else
                {
                ?>
                <script>
                    alert("Succes!");
                </script>
                <?php
                $admins->deleteAdmin($_POST['RemoveAdminText']);
                }
            }
            else
            {

                ?>
                <script>
                    alert("The User is not an admin!");
                </script>
                <?php
            }
        }
        else
        {
            ?>
            <script>
                alert("User does not exist!");
            </script>
            <?php
        }
    }

    if(isset($_POST['BlockUser']))
    {
        $user=$users->verifyUser($_POST['BlockUserText']);
        if($user[0][0]!=0)
        {
            $admin=$admins->checkAdmin($_POST['BlockUserText']);
            if($admin[0][0]==0)
            {

                $block=$blocks->checkBlock($_POST['BlockUserText']);
                if($block[0][0]==0){
                    ?>
                    <script>
                        alert("Succes!");
                    </script>
                    <?php
                    $blocks->insertBlock($_POST['BlockUserText']);}
                else
                {
                    ?>
                    <script>
                        alert("The user is already blocked!");
                    </script>
                    <?php
                }
            }
            else
            {

                ?>
                <script>
                    alert("Cannot block an admin!");
                </script>
                <?php
            }
        }
        else
        {
            ?>
            <script>
                alert("User does not exist!");
            </script>
            <?php
        }
    }
    if(isset($_POST['UnblockUser']))
    {
        $user=$users->verifyUser($_POST['UnblockUserText']);
        if($user[0][0]!=0)
        {
            $admin=$admins->checkAdmin($_POST['UnblockUserText']);
            if($admin[0][0]==0)
            {
               $block=$blocks->checkBlock($_POST['UnblockUserText']);
               if($block[0][0]!=0){
                ?>
                <script>
                    alert("Succes!");
                </script>
                <?php
                $blocks->deleteBlock($_POST['UnblockUserText']);}

               else
               {
                   ?>
                   <script>
                       alert("The user is not blocked!");
                   </script>
                   <?php
               }
            }
            else
            {

                ?>
                <script>
                    alert("Cannot unblock an admin!");
                </script>
                <?php
            }
        }
        else
        {
            ?>
            <script>
                alert("User does not exist!");
            </script>
            <?php
        }
    }
    if(isset($_POST['DeleteChatMessages']))
    {
      $message=$chat->checkMessages($_POST['DeleteChatMessagesText']);

      if($message[0][0]!=0)
      {
          if(isAdmin($_POST['DeleteChatMessagesText']))
          {
              ?>
              <script>
                  alert("You cannot delete the messages of another admin!");
              </script>
              <?php

          }
          else
          {
              $chat->deleteFromAllChatByFrom($_POST['DeleteChatMessagesText']);
              ?>
              <script>
                  alert("Succes!");
              </script>
              <?php
          }

      }
      else
      {
          ?>
          <script>
              alert("No messages to delete!");
          </script>
          <?php
      }

    }




}