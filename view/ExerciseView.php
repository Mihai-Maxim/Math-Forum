<?php
session_start();
if(isset($_GET['te']))
{
    $_SESSION['Exercise']=$_GET['te'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <link rel="stylesheet" type="text/css" href="exercises.css">
    <meta charset="utf-8">
    <title>
        Exercise
    </title>
    <script>

        function aux() {

            var inputs = document.getElementsByTagName('textarea');

            for (var i = 0; i< inputs.length; i++) {

                if (inputs[i].tagName.toLowerCase() == 'textarea') {
                    autoExpand(inputs[i]);
                }
            }

        }
        function image(img) {

            if(img.style.maxHeight=='100px'){
                img.style.maxHeight="500px";
                img.style.maxWidth="500px";}
            else
            {
                img.style.maxHeight="100px";
                img.style.maxWidth="90px";
            }

        }
        function imageReply(img) {

            if(img.style.maxHeight=='50px'){
                img.style.maxHeight="500px";
                img.style.maxWidth="500px";}
            else
            {
                img.style.maxHeight="50px";
                img.style.maxWidth="50px";
            }

        }
        var autoExpand = function (field) {

            field.style.height = 'inherit';


            var computed = window.getComputedStyle(field);

            var height = parseInt(computed.getPropertyValue('border-top-width'), 10)
                + parseInt(computed.getPropertyValue('padding-top'), 10)
                + field.scrollHeight
                + parseInt(computed.getPropertyValue('padding-bottom'), 10)
                + parseInt(computed.getPropertyValue('border-bottom-width'), 10);
           if (document.getElementById('TitleContent')==field)
               field.style.height = height-10 + 'px';
             else
            field.style.height = height + 'px';

        };
        document.addEventListener('input', function (event) {
            if (event.target.tagName.toLowerCase() !== 'textarea') return;
            autoExpand(event.target);
        }, false);
    </script>
</head>
<body id="Exercise" onload="aux()">
<div id="Div">
    <?
    include_once('../controller/exercise_controller.php');
    ?>
</div>

</body>

</html>