<?php

include_once ("/fenrir/studs/mihai.maxim/html/model/connectToDatabase.php");
class chatImageManip
{

    public function insertImageToChat($ID,$IMG_NAME)
    {
        $sql = "INSERT INTO ChatImage (ID,IMG_NAME) VALUES (:ID, :IMG_NAME);";
        $cerere = BD::obtine_conexiune()->prepare($sql);
        return $cerere -> execute (array(
            ':ID' => $ID,
            ':IMG_NAME' =>$IMG_NAME
        ));
    }
    public function getChatImageFromId($ID)
    {
        $sql = "Select * From ChatImage where ID=:ID;";
        $cerere = BD::obtine_conexiune()->prepare($sql);
        $cerere->execute(array(
            ':ID'=>$ID
        ));
        return $cerere->fetchAll();
    }
}