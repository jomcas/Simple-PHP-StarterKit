<?php

include __DIR__. "/../api/accounts/users.php";

// Register POST Action
if(isset($_POST['register'])) {

    // Empty by default
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    if($password != ""){
        $hash = password_hash($password, PASSWORD_BCRYPT);
    }

    // // For duplicate email checking
    $total = selectUserByEmail($email)->num_rows;

    if($total > 0) {
        die("Duplicate Email! Try Again");
    } else {      
        if($firstName == "" || $lastName == "" || $email == "" || $password = "") {	
            die("Error: Invalid Input!");	
        } else {
            $user = array();
            array_push($user, $firstName, $lastName, $email, $hash, "user");
            insertUser($user);
            echo header("Location: login.php");
            }
        }
}

// Login POST Action
if(isset($_POST['login'])) {
    
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    if(empty($email)||empty($password)){
            die("Fill all the fields");
    }
    
    $user = selectUserByEmail($email);
    $total = $user->num_rows;
    $row = $user -> fetch_assoc();

    if(isLoginSuccess($email, $password)) {
        echo "<script> alert('Login Successfully') </script>";
    } else {
        die("Invalid username and/or password! Please try again!");
    }
 }


?>