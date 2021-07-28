<?php
require_once('/fenrir/studs/mihai.maxim/html/model/chatManip.php');
include_once ('chat_image_controller.php');
include_once ('check_if_blacklist.php');
session_start();
if(isset($_POST['SubmitMessage'])) {

    if((!empty($_POST['Message']))&&((strlen(trim($_POST['Message'])) != 0))) {
        $chat = new chatManip();
        $msg = preg_replace('/\s+/', ' ',$_POST['Message']);
        if (isset($_SESSION['Username'])) {
            if(!isBlacklisted($_SESSION['Username'])) {
                if (isset($_SESSION['TalkingTo'])) {
                    $chat->insertMessageTo($_SESSION['Username'], $msg, $_SESSION['TalkingTo']);
                } else
                    $chat->insertMessage($_SESSION['Username'], $msg);
            }
            else
            {
                ?>
                <script>
                    alert('You have been blacklisted by an admin,you cannot use the chat!');
                </script>
                <?php
            }
        } else
            $chat->insertMessage($_SESSION['Anon'], $msg);

    }

}
$images=new chatImageManip();

if(isset($_GET['GetMessages'])) {
    $chat = new chatManip();
    $messages = $chat->getAllMessages();
    if(isset($_SESSION['TalkingTo'])) {
        $messages = $chat->getAllMessagesFromToo($_SESSION['Username'], $_SESSION['TalkingTo']);
    }
    foreach ($messages as $message) {
        if ($message['Content'] != '/.*/') {
            $time = explode(" ", $message['updated_at']);
            if (isset($_SESSION['Username']) && ($_SESSION['Username'] != $message['Frm'])) {
                echo '<div Class="ContainerDiv" >';
                echo '<div Class="MessageOthers"  onmouseover="wait()" onmouseout="run()">';
                echo '<pre>';
                $newtext = wordwrap($time[1] . ' ' . $message['Frm'] . ':' .htmlspecialchars($message['Content']), 35, "\n",true);
                echo '<p   Class="Paragraph">' .$newtext. '</p>';
                echo '</pre>';
                echo '</div>';
                echo '</div>';
                $img=$images->getChatImageFromId($message['ID']);
                if(!empty($img)){
                    echo '<div Class="ContainerDiv" >';
                    echo '<div Class="MessageOthers"  style=" background: #f5f5f5; padding-top: 30px;"  onmouseover="wait()" onmouseout="run()">';
                    $filext=explode('.',$img[0]['IMG_NAME']);
                    $filextlow=strtolower(end($filext));
                    $allowed=array('jpg','jpeg','png','svg');
                    if(in_array($filextlow,$allowed))
                    echo '<img  src="../view/images/'.$img[0]['IMG_NAME'].'">';
                    else
                        echo '<p><a target="_parent" href="../view/images/'.$img[0]['IMG_NAME'].'">'.$img[0]['IMG_NAME'].'</a>'.'</p>';
                    echo '</div>';
                    echo '</div>';}

            } else
                if (isset($_SESSION['Username']) && ($_SESSION['Username'] == $message['Frm'])) {
                    echo '<div Class="ContainerDiv"  >';
                    echo '<div Class="MessageYou"  onmouseover="wait()" onmouseout="run()">';
                    echo '<pre>';
                    $newtext = wordwrap($message['Content'], 35, "\n",true);
                    echo '<p   Class="Paragraph">' .htmlspecialchars($newtext) . '</p>';
                    echo '</pre>';
                    echo '</div>';
                    echo '</div>';

                    $img=$images->getChatImageFromId($message['ID']);
                    if(!empty($img)){
                        echo '<div Class="ContainerDiv" >';
                        echo '<div Class="MessageYou" style=" background: #f5f5f5; padding-top: 30px;"  onmouseover="wait()" onmouseout="run()">';
                        $filext=explode('.',$img[0]['IMG_NAME']);
                        $filextlow=strtolower(end($filext));
                        $allowed=array('jpg','jpeg','png','svg');
                        if(in_array($filextlow,$allowed))
                            echo '<img  src="../view/images/'.$img[0]['IMG_NAME'].'">';
                        else
                            echo '<p><a target="_parent" href="../view/images/'.$img[0]['IMG_NAME'].'">'.$img[0]['IMG_NAME'].'</a>'.'</p>';
                        echo '</div>';
                        echo '</div>';}
                } else
                    if (!isset($_SESSION['Username']) && ($_SESSION['Anon'] != $message['Frm'])) {
                        echo '<div Class="ContainerDiv"  >';
                        echo '<div Class="MessageOthers" onmouseover="wait()" onmouseout="run()" >';
                        echo '<pre>';
                        $newtext = wordwrap( $time[1] . ' ' . $message['Frm'] . ':' .htmlspecialchars($message['Content']), 35, "\n",true);
                        echo '<p   Class="Paragraph">' . '&nbsp;' .$newtext. '</p>';
                        echo '</pre>';
                        echo '</div>';
                        echo '</div>';

                        $img=$images->getChatImageFromId($message['ID']);
                        if(!empty($img)){
                            echo '<div Class="ContainerDiv" >';
                            echo '<div Class="MessageOthers"  style=" background: #f5f5f5; padding-top: 30px;"  onmouseover="wait()" onmouseout="run()">';
                            $filext=explode('.',$img[0]['IMG_NAME']);
                            $filextlow=strtolower(end($filext));
                            $allowed=array('jpg','jpeg','png','svg');
                            if(in_array($filextlow,$allowed))
                                echo '<img  src="../view/images/'.$img[0]['IMG_NAME'].'">';
                            else
                                echo '<p><a target="_parent" href="../view/images/'.$img[0]['IMG_NAME'].'">'.$img[0]['IMG_NAME'].'</a>'.'</p>';
                            echo '</div>';
                            echo '</div>';}
                    } else
                        if (!isset($_SESSION['Username']) && ($_SESSION['Anon'] == $message['Frm'])) {
                            echo '<div Class="ContainerDiv"  >';
                            echo '<div Class="MessageYou" onmouseover="wait()" onmouseout="run()">';
                            echo '<pre>';
                            $newtext = wordwrap($message['Content'], 35, "\n",true);
                            echo '<p  Class="Paragraph">' .htmlspecialchars($newtext) . '</p>';
                            echo '</pre>';
                            echo '</div>';
                            echo '</div>';

                            $img=$images->getChatImageFromId($message['ID']);
                            if(!empty($img)){
                                echo '<div Class="ContainerDiv" >';
                                echo '<div Class="MessageYou" style=" background: #f5f5f5; padding-top: 30px;"   onmouseover="wait()" onmouseout="run()">';
                                $filext=explode('.',$img[0]['IMG_NAME']);
                                $filextlow=strtolower(end($filext));
                                $allowed=array('jpg','jpeg','png','svg');
                                if(in_array($filextlow,$allowed))
                                    echo '<img  src="../view/images/'.$img[0]['IMG_NAME'].'">';
                                else
                                    echo '<p><a target="_parent" href="../view/images/'.$img[0]['IMG_NAME'].'">'.$img[0]['IMG_NAME'].'</a>'.'</p>';
                                echo '</div>';
                                echo '</div>';}
                        }
        }
    }
}