<?php
include_once ("/fenrir/studs/mihai.maxim/html/model/connectToDatabase.php");

class adminsManip
{
    public function checkAdmin($Username)
    {
        $sql = "Select count(*) From Admins where Username=:Username;";
        $cerere = BD::obtine_conexiune()->prepare($sql);
        $cerere->execute(array(
            ':Username'=>$Username
        ));
        return $cerere->fetchAll();
    }
    public function insertAdmin($Username)
    {
        $sql = "INSERT INTO Admins (Username) VALUES (:Username);";
        $cerere = BD::obtine_conexiune()->prepare($sql);
        return $cerere -> execute (array(
            ':Username' => $Username
        ));
    }
    public function deleteAdmin($Username)
    {
        $sql = "DELETE FROM Admins WHERE Username=:Username;";
        $cerere = BD::obtine_conexiune()->prepare($sql);
        return $cerere -> execute (array(
            ':Username' => $Username
        ));
    }

}