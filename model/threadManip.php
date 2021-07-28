<?php
ini_set('display_errors', 1);
include_once ("/fenrir/studs/mihai.maxim/html/model/connectToDatabase.php");
class threadManip
{
    public function insertThread($User,$Title,$Category,$Content)
    {   
        $sql = "INSERT INTO Threads (Username,Title,Category,Content,updated_at,Relevance) VALUES (:Username, :Title,:Category, :Content, :updated_at,:Relevance)";
        $cerere = BD::obtine_conexiune()->prepare($sql);
        return $cerere -> execute (array(
            ':Username' => $User,
            ':Title' => $Title,
            ':Category' => $Category,
            ':Content'=>$Content,
            ':updated_at' => date('Y-m-d H:i:s'),
            ':Relevance'=>0
        ));
       }

    public function getThreadByUser($User)
    {    
         $sql = "Select * From Threads where Username=:Username;";
         $cerere = BD::obtine_conexiune()->prepare($sql);
         $cerere->execute(array(
             ':Username'=>$User
         ));
         return $cerere->fetchAll();
    }
    public function deleteThreadByUser($User)
    {
        $sql = "Delete From Threads where Username=:Username;";
        $cerere = BD::obtine_conexiune()->prepare($sql);
        $cerere->execute(array(
            ':Username'=>$User
        ));

    }
    public function deleteThreadById($Id)
    {
        $sql = "Delete From Threads where ID=:ID;";
        $cerere = BD::obtine_conexiune()->prepare($sql);
        $cerere->execute(array(
            ':ID'=>$Id
        ));

    }
    public function getRelevance($ID)
    {
        $sql = "Select Relevance from Threads where ID=:ID";
        $cerere = BD::obtine_conexiune()->prepare($sql);
        $cerere->execute(array(':ID'=>$ID));
        return $cerere->fetch();
    }
    public function setRelevance($ID,$Relevance)
    {
        $sql = "UPDATE Threads SET Relevance=?  WHERE ID=?";
        $stmt= BD::obtine_conexiune()->prepare($sql);
        $stmt->execute(array($Relevance+1,$ID));
    }
    public function getAllThreads()
    {
        $sql="Select * from Threads order by Relevance desc";
        $cerere = BD::obtine_conexiune()->prepare($sql);
        $cerere->execute();
        return $cerere->fetchAll();
    }
    public function getAllThreadsNewest($Category,$Field)
    {
        $sql="Select * from Threads  where Category=:Category ORDER BY :Field DESC";
        $cerere = BD::obtine_conexiune()->prepare($sql);
        $cerere->execute(array(':Category'=>$Category,':Field'=>$Field));
        return $cerere->fetchAll();

    }
    public function getAllThreadsByRelevance($Category)
    {
        $sql="Select * from Threads where Category=:Category order by Relevance DESC";
        $cerere = BD::obtine_conexiune()->prepare($sql);
        $cerere->execute(array(':Category'=>$Category));
        return $cerere->fetchAll();
    }
    public function getAllThreadsOldest($Category,$Field)
    {
        $sql="Select * from Threads  where Category=:Category order by :Field ASC";
        $cerere = BD::obtine_conexiune()->prepare($sql);
        $cerere->execute(array(':Category'=>$Category,':Field'=>$Field));
        return $cerere->fetchAll();

    }
    public function getThreadByTitle($Title)
    {
        $sql="Select * from Threads where Title=:Title order by Relevance desc";
        $cerere = BD::obtine_conexiune()->prepare($sql);
        $cerere->execute(array(':Title'=>$Title));
        return $cerere->fetchAll();

    }
    public function getThreadsByList($msg)
    {
        $sql="SELECT *
            FROM Threads
            WHERE ID
            IN (
            SELECT ID
            FROM Threads t
            LEFT OUTER JOIN Replies r ON t.ID = r.THREAD_ID
            WHERE t.Title LIKE :MSG
            OR t.Content LIKE :MSG
            OR r.Content LIKE :MSG
            UNION
            SELECT ID
            FROM Threads t
            RIGHT OUTER JOIN Replies r ON t.ID = r.THREAD_ID
            WHERE t.Title LIKE :MSG
            OR t.Content LIKE :MSG
            OR r.Content LIKE :MSG)";
        $cerere = BD::obtine_conexiune()->prepare($sql);
        $cerere->execute(array(':MSG'=>$msg));
        return $cerere->fetchAll();
    }

    public function getAllThreadsGeometrie()
    {
        $sql="Select * from Threads  where Category='Geometrie' order by Relevance desc";
        $cerere = BD::obtine_conexiune()->prepare($sql);
        $cerere->execute();
        return $cerere->fetchAll();
    }
    public function getAllThreadsAlgebra()
    {
        $sql="Select * from Threads  where Category = 'Algebra' order by Relevance desc";
        $cerere = BD::obtine_conexiune()->prepare($sql);
        $cerere->execute();
        return $cerere->fetchAll();
    }

    public function getAllThreadsTrigonometrie()
    {
        $sql="Select * from Threads  where Category='Trigonometrie' order by Relevance desc";
        $cerere = BD::obtine_conexiune()->prepare($sql);
        $cerere->execute();
        return $cerere->fetchAll();
    }
    public function getAllThreadsAnaliza()
    {
        $sql="Select * from Threads  where Category='Analiza' order by Relevance desc";
        $cerere = BD::obtine_conexiune()->prepare($sql);
        $cerere->execute();
        return $cerere->fetchAll();
    }



    public function getThreadIdByUser($Username)
   {
        $sql="Select ID from Threads where Username=:Username order by ID desc limit 1;";
        $cerere = BD::obtine_conexiune()->prepare($sql);
        $cerere->execute(array(':Username'=>$Username));
        return $cerere->fetchAll();
   }
    public function getUserById($ID)
    {
        $sql = "Select Username from Accounts where ID=:ID";
        $cerere = BD::obtine_conexiune()->prepare($sql);
        $cerere->execute(array(':ID'=>$ID));
        return $cerere->fetch();
    }
    public function getTitleById($ID)
    {
        $sql="Select Title from Threads  where ID=:ID";
        $cerere = BD::obtine_conexiune()->prepare($sql);
        $cerere->execute(array(':ID'=>$ID));
        return $cerere->fetchAll();
    }

}