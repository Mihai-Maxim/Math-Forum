<?php

include 'connectToDatabase.php';
class replyManipUser
{

    public function insertReply($USER_ID,$THREAD_ID,$CONTENT,$IMAGE_NAME)
    {
        $sql = "INSERT INTO Replies (USER_ID,THREAD_ID,CONTENT,IMAGE_NAME,UPDATED_AT) VALUES (:USER_ID, :THREAD_ID,:CONTENT,:IMAGE_NAME, :UPDATED_AT)";
        $cerere = BD::obtine_conexiune()->prepare($sql);
        return $cerere -> execute (array(
            ':USER_ID' => $USER_ID,
            ':THREAD_ID' => $THREAD_ID,
            ':CONTENT' =>$CONTENT,
            ':IMAGE_NAME' => $IMAGE_NAME,
            ':UPDATED_AT' => date('Y-m-d H:i:s')
        ));
    }

    public function getAllReplies()
    {
        $sql="Select * from Replies order by UPDATED_AT";
        $cerere = BD::obtine_conexiune()->prepare($sql);
        $cerere->execute();
        return $cerere->fetchAll();
    }
    public function deleteReplyById($ID)
    {
        $sql = "Delete From Replies where REPLY_NUMBER=:ID;";
        $cerere = BD::obtine_conexiune()->prepare($sql);
        $cerere->execute(array(
            ':ID'=>$ID
        ));
    }
    public function updateReplyById($REPLY_NUMBER,$CONTENT)
    {
        $sql = "UPDATE Replies SET Content=?  WHERE REPLY_NUMBER=?";
        $stmt= BD::obtine_conexiune()->prepare($sql);
        $stmt->execute(array($CONTENT,$REPLY_NUMBER));
    }
    public function setRelevance($ID,$Relevance)
    {
        $sql = "UPDATE Threads SET Relevance=?  WHERE ID=?";
        $stmt= BD::obtine_conexiune()->prepare($sql);
        $stmt->execute(array($Relevance-1,$ID));
    }
    public function getThreadIdByReplyId($REPLY_NUMBER)
    {
        $sql = "Select THREAD_ID from Replies where REPLY_NUMBER=:REPLY_NUMBER";
        $cerere = BD::obtine_conexiune()->prepare($sql);
        $cerere->execute(array(
            ':REPLY_NUMBER'=>$REPLY_NUMBER
        ));
        return $cerere->fetchAll();
    }
    public function getRelevance($ID)
    {
        $sql = "Select Relevance from Threads where ID=:ID";
        $cerere = BD::obtine_conexiune()->prepare($sql);
        $cerere->execute(array(':ID'=>$ID));
        return $cerere->fetch();
    }
    public function getThreadTitleByReplyId($ID)
    {
        $sql = "Select Title from Threads t join Replies r on t.ID=r.THREAD_ID WHERE r.REPLY_NUMBER=:ID";
        $cerere = BD::obtine_conexiune()->prepare($sql);
        $cerere->execute(array(
            ':ID'=>$ID,
        ));
        return $cerere->fetchAll();
    }

}