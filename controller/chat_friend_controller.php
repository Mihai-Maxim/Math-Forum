<?php
session_start();
include ("/fenrir/studs/mihai.maxim/html/model/usersManip.php");
include ('/fenrir/studs/mihai.maxim/html/model/chatManip.php');
$users=new usersManip();
$chatManip=new chatManip();
echo '<link rel="stylesheet" type="text/css" href="../view/chatStyle.css">';
if(isset($_GET['GetContacts']))
{
    if(isset($_SESSION['Username'])) {

        $contacts = $chatManip->getAllContactsOfUser($_SESSION['Username']);
        $contactsFrom = $chatManip->getAllContactsOfUserFrm($_SESSION['Username']);
        echo '<form method="POST">';
        foreach ($contacts as $contact) {
            echo '<button class="ContactButton"  name="SelectedContact" value="' . $contact['Too'] . '">';
            echo $contact['Too'];
            echo '</button>';
            echo '<br>';
        }
        foreach ($contactsFrom as $contactFrom) {
            echo '<button class="ContactButton" name="SelectedContact" value="' . $contactFrom['Frm'] . '">';
            echo $contactFrom['Frm'];
            echo '</button>';
            echo '<br>';
        }
        echo '<button class="ContactButton" name="AllChat" >AllChat</button>';
        echo '</form>';


    }

}