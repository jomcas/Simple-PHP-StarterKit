<?php

include __DIR__. "/../services/accountsService.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Register</title>
</head>
<body>
<div class="container mt-5">
    <h1>Register</h1>

    <div class="row">
        <div class="col-sm-8">
            <div class="card">
                <div class="card-body">

                    <form action="" method="POST">
                        <div class="form-group">
                            <label for="name">First Name</label>
                            <input type="text" class="form-control" name="firstName">
                        </div>
                        <div class="form-group">
                            <label for="name">Last Name</label>
                            <input type="text" class="form-control" name="lastName">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password">
                        </div>

                        <button type="submit" class="btn btn-dark float-right" onclick="return alert('Registered Successfully')" name="register">Register</button>
                        <p> Already a member? <a href="/integapp/view/login.php"> Sign In Now! </a></p>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>

