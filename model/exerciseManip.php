<?php
ini_set('display_errors', 1);
include_once ("/fenrir/studs/mihai.maxim/html/model/connectToDatabase.php");
class exerciseManip
{
    public function insertExercise($User,$Title,$Category,$Content)
    {
        $sql = "INSERT INTO Exercises (Username,Title,Category,Content,updated_at,Relevance) VALUES (:Username, :Title,:Category, :Content, :updated_at,:Relevance)";
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

    public function getExerciseByUser($User)
    {
        $sql = "Select * From Exercises where Username=:Username;";
        $cerere = BD::obtine_conexiune()->prepare($sql);
        $cerere->execute(array(
            ':Username'=>$User
        ));
        return $cerere->fetchAll();
    }
    public function deleteExerciseByUser($User)
    {
        $sql = "Delete From Exercises where Username=:Username;";
        $cerere = BD::obtine_conexiune()->prepare($sql);
        $cerere->execute(array(
            ':Username'=>$User
        ));

    }
    public function deleteExerciseById($Id)
    {
        $sql = "Delete From Exercises where ID=:ID;";
        $cerere = BD::obtine_conexiune()->prepare($sql);
        $cerere->execute(array(
            ':ID'=>$Id
        ));

    }
    public function getRelevance($ID)
    {
        $sql = "Select Relevance from Exercises where ID=:ID";
        $cerere = BD::obtine_conexiune()->prepare($sql);
        $cerere->execute(array(':ID'=>$ID));
        return $cerere->fetch();
    }
    public function setRelevance($ID,$Relevance)
    {
        $sql = "UPDATE Exercises SET Relevance=?  WHERE ID=?";
        $stmt= BD::obtine_conexiune()->prepare($sql);
        $stmt->execute(array($Relevance+1,$ID));
    }
    public function getAllExercises()
    {
        $sql="Select * from Exercises order by Relevance desc";
        $cerere = BD::obtine_conexiune()->prepare($sql);
        $cerere->execute();
        return $cerere->fetchAll();
    }
    public function getAllExercisesNewest($Category,$Field)
    {
        $sql="Select * from Exercises  where Category=:Category ORDER BY :Field DESC";
        $cerere = BD::obtine_conexiune()->prepare($sql);
        $cerere->execute(array(':Category'=>$Category,':Field'=>$Field));
        return $cerere->fetchAll();

    }
    public function getAllExercisesByRelevance($Category)
    {
        $sql="Select * from Exercises where Category=:Category order by Relevance DESC";
        $cerere = BD::obtine_conexiune()->prepare($sql);
        $cerere->execute(array(':Category'=>$Category));
        return $cerere->fetchAll();
    }
    public function getAllExercisesOldest($Category,$Field)
    {
        $sql="Select * from Exercises  where Category=:Category order by :Field ASC";
        $cerere = BD::obtine_conexiune()->prepare($sql);
        $cerere->execute(array(':Category'=>$Category,':Field'=>$Field));
        return $cerere->fetchAll();

    }
    public function getExerciseByTitle($Title)
    {
        $sql="Select * from Exercises where Title=:Title order by Relevance desc";
        $cerere = BD::obtine_conexiune()->prepare($sql);
        $cerere->execute(array(':Title'=>$Title));
        return $cerere->fetchAll();

    }
    public function getExercisesByList($msg)
    {
        $sql="SELECT *
            FROM Exercises
            WHERE ID
            IN (
            SELECT ID
            FROM Exercises t
            LEFT OUTER JOIN ExerciseReplies r ON t.ID = r.EXERCISE_ID
            WHERE t.Title LIKE :MSG
            OR t.Content LIKE :MSG
            OR r.Content LIKE :MSG
            UNION
            SELECT ID
            FROM Exercises t
            RIGHT OUTER JOIN ExerciseReplies r ON t.ID = r.EXERCISE_ID
            WHERE t.Title LIKE :MSG
            OR t.Content LIKE :MSG
            OR r.Content LIKE :MSG)";
        $cerere = BD::obtine_conexiune()->prepare($sql);
        $cerere->execute(array(':MSG'=>$msg));
        return $cerere->fetchAll();
    }

    public function getAllExercisesGeometrie()
    {
        $sql="Select * from Exercises  where Category='Geometrie' order by Relevance desc";
        $cerere = BD::obtine_conexiune()->prepare($sql);
        $cerere->execute();
        return $cerere->fetchAll();
    }
    public function getAllExercisesAlgebra()
    {
        $sql="Select * from Exercises  where Category = 'Algebra' order by Relevance desc";
        $cerere = BD::obtine_conexiune()->prepare($sql);
        $cerere->execute();
        return $cerere->fetchAll();
    }

    public function getAllExercisesTrigonometrie()
    {
        $sql="Select * from Exercises  where Category='Trigonometrie' order by Relevance desc";
        $cerere = BD::obtine_conexiune()->prepare($sql);
        $cerere->execute();
        return $cerere->fetchAll();
    }
    public function getAllExercisesAnaliza()
    {
        $sql="Select * from Exercises  where Category='Analiza' order by Relevance desc";
        $cerere = BD::obtine_conexiune()->prepare($sql);
        $cerere->execute();
        return $cerere->fetchAll();
    }
    public function getAllExercisesExport()
    {
        $sql="Select Category,Title,Content from Exercises order by Relevance desc";
        $cerere = BD::obtine_conexiune()->prepare($sql);
        $cerere->execute();
        return $cerere->fetchAll(PDO::FETCH_ASSOC);
    }



    public function getExerciseIdByUser($Username)
    {
        $sql="Select ID from Exercises where Username=:Username order by ID desc limit 1;";
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
        $sql="Select Title from Exercises  where ID=:ID";
        $cerere = BD::obtine_conexiune()->prepare($sql);
        $cerere->execute(array(':ID'=>$ID));
        return $cerere->fetchAll();
    }
    public function getExerciseCount()
    {
        $sql="Select count(*) from Exercises ";
        $cerere = BD::obtine_conexiune()->prepare($sql);
        $cerere->execute();
        return $cerere->fetchAll();
    }

    public function updateExerciseContentById($ID,$CONTENT)
    {

        $sql = "UPDATE Exercises SET Content=?  WHERE ID=?";
        $stmt= BD::obtine_conexiune()->prepare($sql);
        $stmt->execute(array($CONTENT,$ID));

    }

}