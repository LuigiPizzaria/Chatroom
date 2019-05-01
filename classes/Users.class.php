<?php
/**
 * Created by PhpStorm.
 * User: Luisa
 * Date: 02.04.2019
 * Time: 21:32
 */
class Users{

    public $db;

    //construktor wird immer ausgeführt
    function __construct()
    {
        try {
            $this->db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PW);
        }catch (Exception $e){
            echo "Connection not available";
            die();
        }
    }

    public function register($username,$firstname,$password){
        $exists = $this->db->prepare("SELECT * FROM usertable WHERE username '$username'");
        $exists->execute();
        if($exists->rowCount()>0){
            return false;
        }else{
            $stmt = $this->db->prepare("INSERT INTO usertable(username,firstname,passwort) VALUES (:username,:firstname,:password)");
            $stmt->bindValue(":username",$username);
            $stmt->bindValue(":firstname",$firstname);
            $stmt->bindValue(":password",$password);
            $stmt->execute();
            return true;
        }
    }

    public function login($username,$password){
        $exists = $this->db->prepare("SELECT * FROM usertable WHERE username = '$username' AND passwort = '$password'");
        $exists->execute();
        if($exists->rowCount()>0){
            session_start();
            $_SESSION["username"] = $username;
            if(isset($_SESSION["username"])) {
                header("location: homepage.php");
            }
            return true;
        }else{
            header("location: login.php");
            return false;
        }
    }

    public function logout(){
        session_start();
        session_destroy();
        header("location: login.php");
    }

    public function sendmessage($username,$nachricht,$datum){

        $stmt = $this->db->prepare("INSERT INTO nachrichten(username,nachricht,datum) VALUES (:username,:nachricht,:datum)");
        $stmt->bindValue(":username",$username);
        $stmt->bindValue(":nachricht",$nachricht);
        $stmt->bindValue(":datum",$datum);
        $stmt->execute();
    }

    public function showmessage(){
        $stmt = $this->db->prepare("SELECT * FROM nachrichten ORDER BY datum DESC");
        $stmt->execute();
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $res;
    }

    public function deletemessage($choice){
        $exists = $this->db->prepare("DELETE FROM nachrichten WHERE id ='$choice'");
        $exists->execute();
    }

}