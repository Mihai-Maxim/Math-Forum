<?php
ini_set('display_errors', 1);

class exerciseImageManip
{
    public function insertImageToExercise($ID,$IMG_NAME)
    {
        $sql = "INSERT INTO ExerciseImages (ID,IMG_NAME) VALUES (:ID, :IMG_NAME);";
        $cerere = BD::obtine_conexiune()->prepare($sql);
        return $cerere -> execute (array(
            ':ID' => $ID,
            ':IMG_NAME' =>$IMG_NAME
        ));
    }
    public function getExerciseImageFromId($ID)
    {
        $sql = "Select * From ExerciseImages where ID=:ID;";
        $cerere = BD::obtine_conexiune()->prepare($sql);
        $cerere->execute(array(
            ':ID'=>$ID
        ));
        return $cerere->fetchAll();
    }
}