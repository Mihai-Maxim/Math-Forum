<?php


class exerciseReplyManip
{
    public function insertExerciseReply($USER_ID,$EXERCISE_ID,$CONTENT,$IMAGE_NAME)
    {
        $sql = "INSERT INTO ExerciseReplies (USER_ID,EXERCISE_ID,CONTENT,IMAGE_NAME,UPDATED_AT) VALUES (:USER_ID, :EXERCISE_ID,:CONTENT,:IMAGE_NAME, :UPDATED_AT)";
        $cerere = BD::obtine_conexiune()->prepare($sql);
        return $cerere -> execute (array(
            ':USER_ID' => $USER_ID,
            ':EXERCISE_ID' => $EXERCISE_ID,
            ':CONTENT' =>$CONTENT,
            ':IMAGE_NAME' => $IMAGE_NAME,
            ':UPDATED_AT' => date('Y-m-d H:i:s')
        ));
    }
    public function insertExerciseReplyAnon($USER_ID,$EXERCISE_ID,$CONTENT,$IMAGE_NAME,$ANON)
    {
        $sql = "INSERT INTO ExerciseReplies (USER_ID,EXERCISE_ID,CONTENT,IMAGE_NAME,UPDATED_AT,Anon) VALUES (:USER_ID, :EXERCISE_ID,:CONTENT,:IMAGE_NAME, :UPDATED_AT,:Anon)";
        $cerere = BD::obtine_conexiune()->prepare($sql);
        return $cerere -> execute (array(
            ':USER_ID' => $USER_ID,
            ':EXERCISE_ID' => $EXERCISE_ID,
            ':CONTENT' =>$CONTENT,
            ':IMAGE_NAME' => $IMAGE_NAME,
            ':UPDATED_AT' => date('Y-m-d H:i:s'),
            ':Anon'=>$ANON
        ));
    }
    public function getAllExerciseReplies()
    {
        $sql="Select * from ExerciseReplies order by UPDATED_AT";
        $cerere = BD::obtine_conexiune()->prepare($sql);
        $cerere->execute();
        return $cerere->fetchAll();
    }
    public function deleteExerciseReplyById($ID)
    {
        $sql = "Delete From ExerciseReplies where REPLY_NUMBER=:ID;";
        $cerere = BD::obtine_conexiune()->prepare($sql);
        $cerere->execute(array(
            ':ID'=>$ID
        ));
    }
    public function getExerciseRepliesByThreadId($ID)
    {
        $sql="Select count(*) from ExerciseReplies where EXERCISE_ID=:EXERCISE_ID";
        $cerere = BD::obtine_conexiune()->prepare($sql);
        $cerere->execute(array(
            ':EXERCISE_ID'=>$ID
        ));
        return $cerere->fetchAll();
    }
    public function updateExerciseReplyById($REPLY_NUMBER,$CONTENT)
    {
        $sql = "UPDATE ExerciseReplies SET Content=?  WHERE REPLY_NUMBER=?";
        $stmt= BD::obtine_conexiune()->prepare($sql);
        $stmt->execute(array($CONTENT,$REPLY_NUMBER));
    }
    public function getExerciseTitleByReplyId($ID)
    {
        $sql = "Select Title from Exercises t join ExerciseReplies r on t.ID=r.EXERCISE_ID WHERE r.REPLY_NUMBER=:ID";
        $cerere = BD::obtine_conexiune()->prepare($sql);
        $cerere->execute(array(
            ':ID'=>$ID,
        ));
        return $cerere->fetchAll();
    }



}