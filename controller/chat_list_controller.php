<?php
session_start();
include ("/fenrir/studs/mihai.maxim/html/model/usersManip.php");
include ('/fenrir/studs/mihai.maxim/html/model/chatManip.php');
$users=new usersManip();
$chatManip=new chatManip();


if (!isset($_SESSION['Username']))
    {echo '<p style=" font-family :Comic Sans MS;
    opacity:65%;"><strong>You are limited to the public all chat!</strong></p>';
    echo '<p style=" font-family :Comic Sans MS;
    opacity:65%;"><strong>Log in to send private messages!</strong></p>';}
else {
    echo '<form method="POST">';
    echo '<input type="text" name="Contact" placeholder="  User" style="max-width:90%;border-radius: 10px;";>';
    echo '<button class="AddContact" style="display: inline;" name="addContact">Add contact</button>';
    echo '</form>';
    echo '<p style="font-famil :Comic Sans MS;opacity:65%; color:black;font-size: large;"><strong>Contact list</strong></p>';
}



if(isset($_POST['addContact'])&&isset($_SESSION['Username']))
{   $user=$users->getUser($_POST['Contact']);
    if(!empty($user) &&($_POST['Contact']!=$_SESSION['Username']))
    {
        $ifContact=$chatManip->checkIfContact($_SESSION['Username'],$_POST['Contact']);
        if($ifContact[0][0]==0)
        $chatManip->insertMessageTo($_SESSION['Username'],"/.*/",$_POST['Contact']);


    }
    else {
        ?>
        <script>
            alert('User does not exist!');
        </script>
        <?php
    }
}


if (isset($_POST['SelectedContact'])) {
    $_SESSION['TalkingTo'] = $_POST['SelectedContact'];
    echo '<p style=" font-family :Comic Sans MS;
    opacity:65%;"><strong>Talking to:' . $_SESSION['TalkingTo'].'</strong></p>';
}
if (isset($_POST['AllChat'])) {
    unset($_SESSION['TalkingTo']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
<title>
    ContactList
</title>
</head>
<body>
<?php
if(isset($_SESSION['Username']))
echo'
<div id="Contacts" style="width: 70%;border: 1px solid gray;border-radius: 10px;text-align: center;overflow-x: scroll "   >';
?>

</div>
</body>

<script>
    window.setInterval(showContacts, 1000);

    function showContacts() {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("Contacts").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "../controller/chat_friend_controller.php?GetContacts=set", true);
        xmlhttp.send();


    }




</script>

</html>



