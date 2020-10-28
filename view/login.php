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
    <h1>Sign In.</h1>

    <div class="row">
        <div class="col-sm-8">
            <div class="card">
                <div class="card-body">

                    <!-- Makes POST request to /login route -->
                    <form action="" method="POST">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password">
                        </div>
                        <button type="submit" class="btn btn-dark float-right" name="login">Sign In</button>
                        <p> Not yet a member? <a href="/integapp/view/register.php"> Sign Up Now! </a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>