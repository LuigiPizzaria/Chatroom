<?php
/**
 * Created by PhpStorm.
 * User: Luisa
 * Date: 02.04.2019
 * Time: 21:40
 */
session_start();

if(!isset ($_SESSION["username"])){
    header("location: login.php");
}

require_once ("config.inc.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Homepage</title>
    <link rel="stylesheet" type="text/css" href ="style.css" >
</head>
<body>

<h1>Welcome <?php echo $_SESSION["username"];?></h1>

<form action="action.php" method="post">
    <p><input type="submit" name="logout" value="logout"></p>
</form>

<h1>Chat here</h1>
<div>
    <form action="action.php" method="post">
        <p><input type="text" name="chat" placeholder="message"></p>
        <p><input type="submit" name="send"value="send"></p>
    </form>
</div>

<!-- Chat -->
<h1>Chatroom</h1>
<?php
$messages = new Users();
$username = $_SESSION["username"];
foreach ($messages->showmessage() as $result){
    if($result['username'] == $username){
        ?>
        <form action="action.php" method="post">
            <div id="mess">
                <style>#mess{background: yellow; color: darkcyan}</style>

                <p>Name:<?php echo $result['username'] ?></p>
                <p><?php echo $result['nachricht'] ?></p>
                <p>Datum:<?php echo $result['datum'] ?></p>
                <?php echo "<p><input type='radio' name='choice'";
                echo " value='" . $result['id'] ."'></p>"; ?>
                <input type="submit" value="delete" name="deletemessage">

            </div>
        </form>
        <?php
    }else{
        ?>
        <form>
            <div id="mess2">
                <style>#mess2{background: yellowgreen; color: white}</style>
                <p>Name:<?php echo $result['username'] ?></p>
                <p><?php echo $result['nachricht'] ?></p>
                <p>Datum:<?php echo $result['datum'] ?></p>
            </div>
        </form>
        <?php
    }
}
?>

</body>
</html>
