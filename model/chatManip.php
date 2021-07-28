<?php

include_once 'connectToDatabase.php';
class chatManip
{
    public function insertMessage($From,$Content)
    {
        $sql = "INSERT INTO Chat (Frm,Content,updated_at) VALUES (:FRM,:CONTENT,:UPDATED_AT)";
        $cerere = BD::obtine_conexiune()->prepare($sql);
        $cerere -> execute (array(
            ':FRM' => $From,
            ':CONTENT' =>$Content,
            ':UPDATED_AT'=>date('Y-m-d H:i:s')
        ));
    }
    public function getAllMessages()
    {
        $sql="SELECT * FROM Chat where Too is null ORDER BY ID ASC";
        $cerere = BD::obtine_conexiune()->prepare($sql);
        $cerere -> execute();
        return $cerere->fetchAll();
    }
    public function getAllContactsOfUser($user)
    {
        $sql="SELECT * FROM Chat where Frm=:usr AND Content='/.*/'  ORDER BY ID ASC" ;
        $cerere = BD::obtine_conexiune()->prepare($sql);
        $cerere -> execute(array(
            ':usr'=>$user,
        ));
        return $cerere->fetchAll();
    }
    public function getAllContactsOfUserFrm($user)
    {
        $sql="SELECT * FROM Chat where Too=:usr AND Content='/.*/'  ORDER BY ID ASC" ;
        $cerere = BD::obtine_conexiune()->prepare($sql);
        $cerere -> execute(array(
            ':usr'=>$user,
        ));
        return $cerere->fetchAll();
    }
    public function insertMessageTo($From,$Content,$To)
    {
        $sql = "INSERT INTO Chat (Frm,Too,Content,updated_at) VALUES (:FRM,:Too,:CONTENT,:UPDATED_AT)";
        $cerere = BD::obtine_conexiune()->prepare($sql);
        $cerere -> execute (array(
            ':FRM' => $From,
            ':Too'=>$To,
            ':CONTENT' =>$Content,
            ':UPDATED_AT'=>date('Y-m-d H:i:s')
        ));
    }
    public function getAllMessagesFromToo($From,$Too)
    {
        $sql="SELECT * FROM Chat where (Frm=:frm AND Too=:too) or(Frm=:too AND Too=:frm) ORDER BY ID ASC";

        $cerere = BD::obtine_conexiune()->prepare($sql);
        $cerere -> execute(array(
            ':frm'=>$From,
            ':too'=>$Too
        ));
        return $cerere->fetchAll();
    }
    public function checkIfContact($From,$Too)
    {
        $sql="SELECT count(*) FROM Chat where (Frm=:frm AND Too=:too and CONTENT='/.*/') or(Frm=:too AND Too=:frm and CONTENT='/.*/') ORDER BY ID ASC";

        $cerere = BD::obtine_conexiune()->prepare($sql);
        $cerere -> execute(array(
            ':frm'=>$From,
            ':too'=>$Too
        ));
        return $cerere->fetchAll();
    }
    public function getMessageIdByUser($Username)
    {
        $sql="Select ID from Chat where Frm=:Username order by ID desc limit 1;";
        $cerere = BD::obtine_conexiune()->prepare($sql);
        $cerere->execute(array(':Username'=>$Username));
        return $cerere->fetchAll();
    }
    public function deleteFromAllChatByFrom($From)
    {
        $sql = "Delete From Chat where Frm=:Frm and Too is null;";
        $cerere = BD::obtine_conexiune()->prepare($sql);
        $cerere->execute(array(
            ':Frm'=>$From
        ));
    }
    public function checkMessages($From)
    {
        $sql = "Select count(*) from Chat where Frm=:Frm and Too is null;";
        $cerere = BD::obtine_conexiune()->prepare($sql);
        $cerere->execute(array(
            ':Frm'=>$From
        ));
        return $cerere->fetchAll();
    }


}