<?php

include_once('../controller/chat_controller.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <link rel="stylesheet" type="text/css" href="../view/chatStyle.css">
</head>
<body>
<div ID="Messages" class="MessagesText" >

</div>
<div style="width: 100%;height: 10px;position: relative;">

</div>

</body>
<script>

  var todo='true';

    function showUser() {
        if(todo!='false') {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("Messages").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET", "../controller/chat_controller.php?GetMessages=set", true);
            xmlhttp.send();
        }

    }


    window.setInterval(showUser, 1000);


     function wait() {

         todo='false';
         setTimeout(function () {
             todo='true';


         },5000)

    }
    function  run() {
         todo='true';

    }


</script>
</html>
