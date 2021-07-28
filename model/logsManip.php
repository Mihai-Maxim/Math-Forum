<?php
include_once 'connectToDatabase.php';
class logsManip
{
    public function insertLog($From,$Title,$Category)
    {
        $sql = "INSERT INTO Logs (Frm,Title,Category,updated_at) VALUES (:Frm,:Title,:Category,:updated_at)";
        $cerere = BD::obtine_conexiune()->prepare($sql);
        $cerere -> execute (array(
            ':Frm' => $From,
            ':Title' =>$Title,
            ':Category'=>$Category,
            ':updated_at'=>date('Y-m-d H:i:s')
        ));
    }
    public function getLogs()
    {
        $sql = "select * from Logs";
        $cerere = BD::obtine_conexiune()->prepare($sql);
        $cerere ->execute ();
        return $cerere->fetchAll();
    }

}