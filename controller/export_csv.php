<?php
session_start();
include_once ('../model/exerciseManip.php');
include_once ('../model/blacklistManip.php');
include_once('../model/logsManip.php');

function arrayToCsv(array &$array)
{
    if (count($array) == 0) {
        return null;
    }
    ob_start();
    $df = fopen("../view/export.csv", 'r+w');
    ftruncate($df,0);
    fputcsv($df, array_keys(reset($array)));
    foreach ($array as $row) {
        fputcsv($df,array_values($row));
    }
    fclose($df);
    $filename="../view/export.csv";
    $now = gmdate("D, d M Y H:i:s");
    header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
    header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
    header("Last-Modified: {$now} GMT");


    header("Content-Type: application/force-download");
    header("Content-Type: application/octet-stream");
    header("Content-Type: application/download");

    header('Content-Disposition: attachment; filename="'. basename($filename) . '";');
    header("Content-Transfer-Encoding: binary");
    header('Content-Length: ' . filesize($filename));
    readfile($filename);
    die();
    return ob_get_clean();

}

if(isset($_POST['ExportCsv']))
{
   $exercises=new exerciseManip();
   $exercise=$exercises->getAllExercisesExport();
   arrayToCsv($exercise);

}
if(isset($_SESSION['Username']))
    echo '
    <form method="POST"  enctype="multipart/form-data">
        <button name="ExportCsv" type="submit">Export as Csv</button>
        <button name="ImportCsv" type="submit">Import Csv</button>
        <input type="file"  accept=".csv" name="ImportCsvFileRequest" value="set" ></input>
    </form>';
if(isset($_POST['ImportCsv']))
{   $exercises=new exerciseManip();
    $blocked=new blacklistManip();
    $block=$blocked->checkBlock($_SESSION['Username']);
    if($block[0][0]==0){
    if(isset($_FILES['ImportCsvFileRequest']))
    {
        $file=$_FILES['ImportCsvFileRequest'];
        $name=$_FILES['ImportCsvFileRequest']['name'];
        $fileTmp=$_FILES['ImportCsvFileRequest']['tmp_name'];
        $size=$_FILES['ImportCsvFileRequest']['size'];
        $error=$_FILES['ImportCsvFileRequest']['error'];
        $type=$_FILES['ImportCsvFileRequest']['type'];

        $filext=explode('.',$name);
        $filextlow=strtolower(end($filext));

        if($error===0){
            if($size<100000000)
            {

                $filenew=uniqid('',true).".".$filextlow;
                $destination='../view/images/'.$filenew;
                move_uploaded_file($fileTmp,$destination);
                $csvData = file_get_contents($destination);
                $lines = explode(PHP_EOL, $csvData);
                $array = array();
                foreach ($lines as $line) {
                    $array[] = str_getcsv($line);
                }
                if(($array[0][0]=="Category")&&($array[0][1]=="Title")&&($array[0][2]=="Content")){
                $logs=new logsManip();
                foreach ($array as $row)
                {
                    if($row[0]!="Category")
                    {   $allowed=array('Algebra','Trigonometrie','Geometrie','Analiza');
                        if(in_array($row[0],$allowed) )
                        {
                            if(strlen($row[1])<=80)
                            {
                                if(strlen($row[2])<=5000)
                                {
                                    echo $row[0];
                                    echo '<br>';
                                    echo $row[1];
                                    echo '<br>';
                                    echo $row[2];
                                    echo '<br>';
                                    echo 'Has been inserted!';
                                    echo '<br>';
                                    echo '<br>';
                                    $exercises->insertExercise($_SESSION['Username'],$row[1],$row[0],$row[2]);
                                    $logs->insertLog($_SESSION['Username'],$row[1],7);
                                }

                            }
                        }
                    }

                }

                }


            }
            else
            {  ?>
                <script>
                    alert("File too big!");
                </script>
                <?php
            }
        }
        else
        {   ?>
            <script>
                alert("Select a Csv file to import!");
            </script>
            <?php
        }

    }}
    else
    {
        ?>
        <script>
            alert("You have been blacklisted by an admin,you cannot post!");
        </script>
        <?php
    }
}