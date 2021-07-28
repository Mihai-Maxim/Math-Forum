<?php
include_once('/fenrir/studs/mihai.maxim/public_html/model/exerciseManip.php');
include_once('/fenrir/studs/mihai.maxim/public_html/model/exerciseImageManip.php');
session_start();

header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");


if(isset($_GET["e"]) ||isset($_GET['SearchExercise'])){
    header("Refresh:0");
    if(isset($_GET['ExerciseCategory']))
    {
        $_SESSION['ExerciseCategory']=$_GET['ExerciseCategory'];
    }
    if(isset($_GET['ExerciseByDate']))
    {
        $_SESSION['ExerciseByDate']=$_GET['ExerciseByDate'];
    }

    $xml = new DOMDocument("1.0","UTF-8");
    $xml->load('/fenrir/studs/mihai.maxim/public_html/view/exercises.xml');


    $elements = $xml->getElementsByTagName('Exercise');
    for ($i = $elements->length; --$i >= 0; ) {
        $href = $elements->item($i);
        $href->parentNode->removeChild($href);
    }
    $exercises=new exerciseManip();
    $images=new exerciseImageManip();
    if(!isset($_SESSION['ExerciseCategory']))
    $results=$exercises->getAllExercises();
    else
    {
        if($_SESSION['ExerciseCategory']=='All')
        {
            $results=$exercises->getAllExercises();
        }
        else
            if($_SESSION['ExerciseCategory']=='Geometrie')
            {
                $results=$exercises->getAllExercisesGeometrie();
            }
            else
                if($_SESSION['ExerciseCategory']=='Algebra')
                {
                    $results=$exercises->getAllExercisesAlgebra();
                }
                else
                    if($_SESSION['ExerciseCategory']=='Trigonometrie')
                    {
                        $results=$exercises->getAllExercisesTrigonometrie();
                    }
                    else
                        if($_SESSION['ExerciseCategory']=='Analiza')
                        {
                            $results=$exercises->getAllExercisesAnaliza();

                        }
    }
    if($_SESSION['ExerciseByDate']=='Newest')
    {

        usort($results, function($a, $b) {
            return $b['ID'] - $a['ID'];
        });

    }else
        if($_SESSION['ExerciseByDate']=='Oldest')
        {
            usort($results, function($a, $b) {
                return $a['ID'] - $b['ID'];
            });

        }
   if(isset($_GET['SearchExercise'])) {
       $msg= '%'.str_replace(' ','%',$_GET['SearchExerciseContent']).'%';
       $results = $exercises->getExercisesByList($msg);
       if(empty($results))
       {
           ?>
           <script>
               alert("Input not found");
               location="../view/exercises.xml";
           </script>
           <?php
       }
   }




    $pages=0;
    foreach($results as $row)
        $pages+=1;

    $_SESSION['Pages']=$pages;
    $lowerLimit=0;
    $upperLimit=15;
    $count=0;
    if(isset($_GET['Page']))
    {
        $upperLimit=($_GET['Page']+1)*15;
        $lowerLimit=($_GET['Page'])*15;

    }
    if(isset($_GET['Special']))
    {
        ?>
        <script type="text/javascript">
            location="../view/exercises.xml";

        </script>
        <?php
    }
    if(empty($results) && isset($_GET['noRedirect'])) {
        ?>
        <script type="text/javascript">
            alert("Empty category...");
            location="../view/exercises.xml";

        </script>
        <?php

    }


    foreach($results as $row) {
        if(($count>=$lowerLimit)&&($count<$upperLimit)) {
            $rootTag = $xml->getElementsByTagName('Exercises')->item(0);
            $user = $xml->createElement('User');
            $text = $xml->createTextNode($row['Username']);
            $user->appendChild($text);
            $title = $xml->createElement('Title', $row['Title']);
            $category = $xml->createElement('Category', $row['Category']);
            $content = $xml->createElement('Content', $row['Content']);
            $date = $xml->createElement('Date', $row['updated_at']);
            $idtag = $xml->createElement('Id', $row['ID']);


            $id = $row['ID'];
            $id = $images->getExerciseImageFromId($id);
            if ($id === 0)
                $image = $xml->createElement('Image', '');
            else
                $image = $xml->createElement('Image', $id[0]['IMG_NAME']);

            $filext = explode('.', $id[0]['IMG_NAME']);
            $filextlow = strtolower(end($filext));
            $allowed = array('jpg', 'jpeg', 'png', 'svg');
            if (in_array($filextlow, $allowed)) {
                $resource = $xml->createElement('Resource', -1);

            } else
                $resource = $xml->createElement('Resource', 1);


            $thread = $xml->createElement("Exercise");

            $thread->appendChild($user);
            $thread->appendChild($title);
            $thread->appendChild($category);
            $thread->appendChild($content);
            $thread->appendChild($image);
            $thread->appendChild($date);
            $thread->appendChild($idtag);
            $thread->appendChild($resource);
            if (strcmp($row['Username'], $_SESSION['Username']) == 0) {
                $threadAdmin = $xml->createElement('ExerciseAdmin', $row['ID']);
            } else
                $threadAdmin = $xml->createElement('ExerciseAdmin', -1);
            $thread->appendChild($threadAdmin);
            $rootTag->appendChild($thread);
        }
        $count+=1;
        $xml->save('/fenrir/studs/mihai.maxim/public_html/view/exercises.xml');

    }



    clearstatcache();
 if(isset($_GET['noRedirect'])) {
 ?>
<script type="text/javascript">
    location="../view/exercises.xml";

</script>
<?php
 }

 else
 {
     ?>
<script type="text/javascript">
    location="view/exercises.xml";

</script>
<?php
 }
}

?>