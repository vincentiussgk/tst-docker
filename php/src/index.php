<?php
//These are the defined authentication environment in the db service

// The MySQL service named in the docker-compose.yml.
$host = 'db';

// Database use name
$user = 'MYSQL_USER';

//database user password
$pass = 'MYSQL_PASSWORD';

// database name
$mydatabase = 'MYSQL_DATABASE';
// check the mysql connection status

$conn = new mysqli($host, $user, $pass, $mydatabase);

// select query
$sql = 'SELECT * FROM users';

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $myusername = mysqli_real_escape_string($conn,$_POST['name']);
    $mypassword = hash('ripemd160', mysqli_real_escape_string($conn,$_POST['password'])); 

    $sql = "SELECT id FROM users WHERE username = '$myusername' and password = '$mypassword'";
    $result = mysqli_query($conn,$sql);

    $count = mysqli_num_rows($result);

    if($count == 1) {
        header("Location: success.php", false);
    }else {
        $error = "Username or Password invalid.";
        echo "<script type='text/javascript'>alert('$error');</script>";
    }


}

?>

<html>
    <head>
        <title>Login Page</title>
        <link rel="stylesheet" href="index.css">
    </head>
    <body>

    <form action="" method="post" class="container">
        Username <input type="text" name="name" class="input"><br>
        Password <input type="password" name="password" class="input"><br>
        <input type="submit" name="Login" value="Login" class="button">
    </form>

    </body>
</html>
