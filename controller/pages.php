<?php
session_start();
if(isset($_SESSION['Pages'])) {
    $nrOfPages = $_SESSION['Pages'][0]/10;
    if($_SESSION['Pages'][0]<10)
        $nrOfPages+=1;

    for($i=0;$i<$nrOfPages;$i=$i+1)
    {
       echo '<a target="_parent" href=../exercises_xml.php?e=">'.$i.'</a>';
    }
    }