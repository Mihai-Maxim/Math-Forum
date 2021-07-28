

<?php

ini_set('display_errors', 1);
define('SLASH',DIRECTORY_SEPARATOR);
include('controller'.SLASH.'login_register.php');
include('controller'.SLASH.'insert_thread.php');
include('controller'.SLASH.'thread_xml.php');
include('controller'.SLASH.'exercises_xml.php');
include('controller'.SLASH.'insert_image.php');
include ('controller'.SLASH.'check_if_blacklist.php');
include(SLASH.'fenrir'.SLASH.'studs'.SLASH.'mihai.maxim'.SLASH.'html'.SLASH.'controller'.SLASH.'chat_controller.php');
include(SLASH.'fenrir'.SLASH.'studs'.SLASH.'mihai.maxim'.SLASH.'html'.SLASH.'controller'.SLASH.'reply_detection.php');


session_start();

if(!isset($_SESSION['Anon'])){
    $var="Anon".rand(10,10000);
    $_SESSION["Anon"]=$var;}
if(!isset($_SESSION['Category']))
    $_SESSION['Category']='';


if(!isset($_SESSION['ReplyLimit']))
    $_SESSION['ReplyLimit'] ='true';

if(!isset($_SESSION['NewReplies']))
    $_SESSION['NewReplies'] ='';

if(!isset($_SESSION['NewRepliesShow']))
    $_SESSION['NewRepliesShow'] ='false';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <script  src="http://latex.codecogs.com/editor3.js"></script>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="view/Style.css">
    <link rel="stylesheet" type="text/css" href="view/chatStyle.css">
    <link rel="stylesheet" type="text/css" href="view/activityLog.css">
    <title>MeQ</title>

</head>

<body style="background-color: #f5f5f5">
<header id="Header">
    <ul id="Subjects">
        <li>MeQ</li>
        <li onclick="displayThreadsAlgebra()"><u  id="Alg"  class="Shortcut">Algebra</u></li>
        <li onclick="displayThreadsTrigonometrie()"><u id="Trig" class="Shortcut">Trigonometrie</u></li>
        <li onclick="displayThreadsGeometrie()"><u id="Geo" class="Shortcut">Geometrie</u></li>
        <li onclick="displayThreadsAnaliza()"><u id="Ana" class="Shortcut">Analiza</u></li>
        <li><button onclick="display('Register')" class="RegularButton blue">Register</button></li>
        <li><button onclick="display('Login')" class="RegularButton green">Login</button></li>
        <li>
            <div id="Searchbar">
                <form id="Searchform" method="get">
                    <button type="submit" id="SearchButton" name="SearchButton"> Search</button>
                    <input type="text" name="SearchMessage" id="SearchInput" placeholder="ex:Vectors">
                </form>
            </div>

        </li>

        <li id="Notification" style="font-size: 10px;
        font-size: 20px;display: inline;"><U></U></li>

    </ul>


</header>

<div class="content">
    <div class="leftSide" id="LeftSide">
       <div id="User" style="font-weight: bold;"><h4 >""</h4></div>
        <ul id="NavList">
            <li onclick="displayHomeFrame()"><strong>Home</strong></li>
            <li onclick="displayFrame()"><strong>Threads</strong></li>
            <li onclick="displayFrameExercise()"><strong>Exercises</strong></li>
            <li onclick="displayChat()"><strong>Live chat</strong></li>
            <li onclick="display('newThread')"><strong>Start new thread</strong></li>
            <li onclick="displayThreads()"><strong>Browse Threads</strong></li>
            <li onclick="displayActiviyLog()"><strong>Activity log</strong></li>

            <li> <a style="color: inherit; text-decoration:none;" href="javascript:OpenLatexEditor('testbox','html','')">
                    <strong> CodeCogs Equation Editor</strong>
                </a>  </li>
        </ul>


    </div>
    <div class="rightSide" style="background-color: #f5f5f5">
        <iframe  id="HomeFrame" src="view/HomeView.php"></iframe>
        <iframe  id="Frame" src="view/threads.xml"></iframe>
        <iframe  id="Frame2" src="view/exercises.xml"></iframe>
        <div id="rightBanner" style=" position:sticky ;float : right; background-color:#f5f5f5;" >
            <div id="Activitylog" style="display: block">
                <div class="Logs" id="Logs">
                    <h2 style=" font-family :'Comic Sans MS';opacity: 65%;">Activity log</h2>
                    <iframe style=" border-radius: 10px; background-color: #f5f5f5; width:100%;height: 100%;  transform: rotate(180deg); border: 1px solid grey;" src="view/Logs.php">

                    </iframe>

                </div>

                <div class="AdminConsole" style="display:none;">
                    <h2 style=" font-family :'Comic Sans MS';opacity: 65%;text-align: center; ">Admin Console</h2>
                    <iframe style="border-radius: 10px; border: 1px solid gray; height: 350px; width: 100%;" src="controller/admin_controller.php">

                    </iframe>
                </div>
            </div>

        </div>

        <?php
        include ('controller'.SLASH.'right_side_controller.php');
        ?>

        <?php
        include ('view'.SLASH.'Chat.php');
        ?>



    </div>
</div>


<footer>
    <form method="GET">
        <button type="submit"  id="ThreadPress" name="t"  >Start new thread then click me</button>
    </form>

    <form method="GET">
        <button type="submit" style="display: none"  id="ExercisePress" name="e"  >Start new exercise then click me</button>
    </form>

</footer>
<script src="controller/Scripts.js">

</script>

</body>
<?php
if(isset( $_SESSION['LoggedStatus']))
{
    ?>
    <script>
        var name='<?php echo $_SESSION['Username'];?>';
        document.getElementById('User').innerHTML='Wellcome: <br> </br>'+" "+name;
        document.getElementById('User').style.display="block";
    </script>

    <?php
    if(isset($_SESSION['IsAdmin']))
    {
    ?>
    <script>
        var name='<?php echo $_SESSION['Username'];?>';
        document.getElementById('User').innerHTML='Wellcome: <br> (Admin) <br>'+" "+name;
        document.getElementById('User').style.display="block";
    </script>

    <?php
    }
    else
        if(isBlacklisted($_SESSION['Username']))
        {
    ?>
    <script>
        var name='<?php echo $_SESSION['Username'];?>';
        document.getElementById('User').innerHTML='Wellcome: <br> (Blacklisted) <br>'+" "+name;
        document.getElementById('User').style.display="block";
    </script>

    <?php
        }


}
if(isset($_SESSION['IsAdmin']))
{
    ?>
    <script>
        document.getElementsByClassName('AdminConsole')[0].style.display="block";
    </script>
    <?php
}

?>
</html>

