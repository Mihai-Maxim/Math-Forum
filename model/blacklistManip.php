<?php
include_once ("/fenrir/studs/mihai.maxim/html/model/connectToDatabase.php");

class blacklistManip
{

    public function checkBlock($Username)
    {
        $sql = "Select count(*) From Blacklist where Username=:Username;";
        $cerere = BD::obtine_conexiune()->prepare($sql);
        $cerere->execute(array(
            ':Username'=>$Username
        ));
        return $cerere->fetchAll();
    }
    public function insertBlock($Username)
    {
        $sql = "INSERT INTO Blacklist (Username) VALUES (:Username);";
        $cerere = BD::obtine_conexiune()->prepare($sql);
        return $cerere -> execute (array(
            ':Username' => $Username
        ));
    }
    public function deleteBlock($Username)
    {
        $sql = "DELETE FROM Blacklist WHERE Username=:Username;";
        $cerere = BD::obtine_conexiune()->prepare($sql);
        return $cerere -> execute (array(
            ':Username' => $Username
        ));
    }
}