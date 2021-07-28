<?php
include 'connectToDatabase.php';
class usersManip 
{
   public function insertUser($utilizator,$parola,$email)
   {
    $sql = "INSERT INTO Accounts (Username,Pass,Email,updated_at) VALUES (:Username, :Pass, :Email, :updated_at)";
    $cerere = BD::obtine_conexiune()->prepare($sql);
    return $cerere -> execute (array(':Username' => $utilizator,':Pass' => $parola,':Email' => $email,':updated_at' => date('Y-m-d H:i:s')));
   }
   public function deleteUser($utilizator)
   {
    $sql = "Delete From Accounts where Username=:Username;";
    $cerere = BD::obtine_conexiune()->prepare($sql);
    $cerere->execute(array(':Username'=>$utilizator));
    return $cerere->fetchAll();
   }

   public function verifyUser($username)
   {
    $sql = "Select count(*) from Accounts where Username=:Username";
    $cerere = BD::obtine_conexiune()->prepare($sql);
    $cerere->execute(array(':Username'=>$username));
    return $cerere->fetch();
   }
   public function getUser($username)
{
    $sql = "Select ID from Accounts where Username=:Username";
    $cerere = BD::obtine_conexiune()->prepare($sql);
    $cerere->execute(array(':Username'=>$username));
    return $cerere->fetch();
}
   public function getUserById($ID)
   {
       $sql = "Select Username from Accounts where ID=:ID";
       $cerere = BD::obtine_conexiune()->prepare($sql);
       $cerere->execute(array(':ID'=>$ID));
       return $cerere->fetch();
   }
    public function verifyUserEmail($email)
    {
        $sql = "Select count(*) from Accounts where Email=:Email";
        $cerere = BD::obtine_conexiune()->prepare($sql);
        $cerere->execute(array(':Email'=>$email));
        return $cerere->fetch();
    }
    public function verifyUserLogin($username,$password)
    {
        $sql = "Select count(*) from Accounts where Username=:Username and Pass=:Pass";
        $cerere = BD::obtine_conexiune()->prepare($sql);
        $cerere->execute(array(':Username'=>$username,':Pass'=>$password));
        return $cerere->fetch();
    }
    public function updateThreadContentById($ID,$CONTENT)
    {

        $sql = "UPDATE Threads SET Content=?  WHERE ID=?";
        $stmt= BD::obtine_conexiune()->prepare($sql);
        $stmt->execute(array($CONTENT,$ID));


    }

    public function getThreadIdByUsernameAndContent($Username,$Content)
    {
        $sql = "Select * From Threads where Username=:Username and Content=:Content";
        $cerere = BD::obtine_conexiune()->prepare($sql);
        $cerere->execute(array(
            ':Username'=>$Username,
            ':Content'=>$Content
        ));
        return $cerere->fetchAll();
    }
    public function getTitleById($ID)
    {
        $sql="Select Title from Threads  where ID=:ID";
        $cerere = BD::obtine_conexiune()->prepare($sql);
        $cerere->execute(array(':ID'=>$ID));
        return $cerere->fetchAll();
    }

}
?>