<?php


class replyManip
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
    public function insertReplyAnon($USER_ID,$THREAD_ID,$CONTENT,$IMAGE_NAME,$ANON)
    {
        $sql = "INSERT INTO Replies (USER_ID,THREAD_ID,CONTENT,IMAGE_NAME,UPDATED_AT,Anon) VALUES (:USER_ID, :THREAD_ID,:CONTENT,:IMAGE_NAME, :UPDATED_AT,:Anon)";
        $cerere = BD::obtine_conexiune()->prepare($sql);
        return $cerere -> execute (array(
            ':USER_ID' => $USER_ID,
            ':THREAD_ID' => $THREAD_ID,
            ':CONTENT' =>$CONTENT,
            ':IMAGE_NAME' => $IMAGE_NAME,
            ':UPDATED_AT' => date('Y-m-d H:i:s'),
            ':Anon'=>$ANON
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
    public function getRepliesByThreadId($ID)
    {
        $sql="Select count(*) from Replies where THREAD_ID=:THREAD_ID";
        $cerere = BD::obtine_conexiune()->prepare($sql);
        $cerere->execute(array(
            ':THREAD_ID'=>$ID
        ));
        return $cerere->fetchAll();
    }


}