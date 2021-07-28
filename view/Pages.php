<?php
session_start();
include_once('/fenrir/studs/mihai.maxim/public_html/model/exerciseManip.php');
if(!isset($_SESSION['Pages']))
{
    $exerc=new exerciseManip();
    $exercises=$exerc->getAllExercises();
    $pages=0;
    foreach($exercises as $row)
        $pages+=1;
    $_SESSION['Pages']=$pages;

}
if(isset($_SESSION['Pages'])) {
    $nrOfPages = $_SESSION['Pages']/15;


    for($i=0;$i<$nrOfPages;$i=$i+1)
    {



    if ( window.location !== window.parent.location )
    {

        echo '<a target="_parent" href="../home.php?e=&Page='.$i.'">'.$i.'</a>';
        echo '&nbsp;';

    }
    else
    {

        echo '<a target="_parent" href="/home.php?e=&Page='.$i.'">'.$i.'</a>';
        echo '&nbsp;';
    }



    }
}