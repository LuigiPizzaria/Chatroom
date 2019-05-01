<?php
/**
 * Created by PhpStorm.
 * User: Luisa
 * Date: 02.04.2019
 * Time: 21:34
 */

include_once ("config.inc.php");

if (isset($_POST['user'])){

    $user = $_POST['user'];

    try {
        $db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PW);
    }catch (Exception $e){
        echo "Connection not available";
        die();
    }

    $exists = $db->prepare("SELECT * FROM usertable WHERE username = '$user'");
    $exists->execute();
    if($exists->rowCount()>0){
        echo '<p style="color: red">User already exists</p>';
    }else{
        echo '<p style="color: green">Username available</p>';
    }
}