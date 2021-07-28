<?php

class imageManip
{
    public function insertImageToThread($ID,$IMG_NAME)
    {   
        $sql = "INSERT INTO Images (ID,IMG_NAME) VALUES (:ID, :IMG_NAME);";
        $cerere = BD::obtine_conexiune()->prepare($sql);
        return $cerere -> execute (array(
            ':ID' => $ID,
            ':IMG_NAME' =>$IMG_NAME
        ));
    }
    public function getThreadImageFromId($ID)
    {
        $sql = "Select * From Images where ID=:ID;";
        $cerere = BD::obtine_conexiune()->prepare($sql);
        $cerere->execute(array(
            ':ID'=>$ID
        ));
        return $cerere->fetchAll();
    }

    

}
