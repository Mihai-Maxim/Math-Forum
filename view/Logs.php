<?php

include_once('../controller/chat_controller.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" type="text/css" href="../view/activityLog.css">
    <meta charset="utf-8">

    <title>ActivityLog</title>
</head>
<body>
<div ID="Logs" class="LogsText">

</div>
<div style="width: 100%;height: 10px;position: relative;">

</div>

</body>
<script>

    window.setInterval(showUser, 1000);

    function showUser() {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("Logs").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "../controller/logs_controller.php?GetLogs=set", true);
        xmlhttp.send();

    }


</script>
</html>
