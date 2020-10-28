<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

function db_setup() {
    include_once "connection.php";
    $con = connection();
    return $con;
}

function createDatabase() {
    include_once "connection.php";
    $con = DBLessConnection();
    $sql = "CREATE DATABASE webapp_DB";
    $con->query($sql) or die($con->error);
    $con->close();
}

function createUserTable($con) {
    $usersTable = 
        "CREATE TABLE `users` (".
            "`userID` int AUTO_INCREMENT PRIMARY KEY,".
            "`firstName` varchar(50) NOT NULL,".
            "`lastName` varchar(50) NOT NULL,".
            "`email` varchar(50) NOT NULL,".
            "`password` varchar(255) NOT NULL,".
            "`access` varchar(10) NOT NULL) ";

    $con->query($usersTable) or die ($con->error);
    $password = password_hash('Admin123!', PASSWORD_BCRYPT);

    $con->close();
}

createDatabase();
$con = db_setup();
createUserTable($con);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Integ App Test</title>
</head>

<body>
    <p> Database Created! <a class="btn btn-link" href="/"> Go to Login!
        </button></p>
</body>

</html>
