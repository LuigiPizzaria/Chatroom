<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href ="style.css" >
</head>
<body>
<div id="divlogin">
<p>Register</p>
<form action="action.php" method="post">
    <p><input type="text" name="username" id="user_name" onkeyup="usercheck()">Username</p>
    <div id="checking"></div>
    <P><input type="text" name="firstname">First-Name</P>
    <p><input type="password" name="password">Password</p>
    <p><input type="submit" name="register" id="register" value="register"></p>
</form>

<p>Login</p>
<form action="action.php" method="post">
    <p><input type="text" name="username">Username</p>
    <p><input type="password" name="password">Password</p>
    <p><input type="submit" name="login" value="login"></p>
</form>
</div>
</body>
</html>

<!-- ajax -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
    function usercheck() {
        var user_name = document.getElementById("user_name").value;

        $.post("ajax.php",{
                user: user_name
            },
            function (data,status) {
                if(data == '<p style="color: red">User already exists</p>'){
                    document.getElementById("register").disabled = true;
                }else{
                    document.getElementById("register").disabled = false;
                }
                document.getElementById("checking").innerHTML = data;
            }
        );
    }
</script>