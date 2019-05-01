<?php
/**
 * Created by PhpStorm.
 * User: Luisa
 * Date: 02.04.2019
 * Time: 21:37
 */
require_once ("config.inc.php");

$users = new Users();

if (isset($_POST['register'])){
    //secure
    $myusername = htmlentities($_POST['username']);
    $myfirstname = htmlentities($_POST['firstname']);
    $mypassword = md5($_POST['password'],PASSWORD_DEFAULT);
    //function
    $users->register($myusername,$myfirstname,$mypassword);
    header("location: login.php");
}

if(isset($_POST['login'])){
    //secure
    $myusername = htmlentities($_POST['username']);
    $mypassword = md5($_POST['password'],PASSWORD_DEFAULT);
    //function
    $users->login($myusername,$mypassword);

}

if (isset($_POST['logout'])){
    $users->logout();
}

if(isset($_POST['send'])){
    session_start();
    $username = $_SESSION["username"];
    $text = htmlentities($_POST['chat']);
    $date = date("Y-m-d h:i:s");
    $users->sendmessage($username,$text,$date);
    header("location: homepage.php");
}

if (isset($_POST['deletemessage'])){
    session_start();
    $choice = $_POST['choice'];
    $users->deletemessage($choice);
    header("location: homepage.php");
}