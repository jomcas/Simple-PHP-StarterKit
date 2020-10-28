<?php
// header("Access-Control-Allow-Origin: *");
// header("Content-Type: application/json; charset=UTF-8");

include __DIR__. "/../database/connection.php";
$con = connection();

//$id = $_GET['ID'];

function selectAllUsers() {
    global $con;

    if($con==null){
        sendResponse(500,$con,'Server Connection Error');
    }else{
        $statement = "
        SELECT 
            userID, firstName, lastName, email, password, access
        FROM
            users;
        ";

        $result = $con->query($statement) or die ($con->error);

        returnUserJSON($result);
    
        $con->close();
    }

    return $result;
}

function selectUser($id) {
    global $con;

    if($con==null){
        sendResponse(500,$con,'Server Connection Error');
    }else{
        $statement = "
        SELECT 
            userID, firstName, lastName, email, password, access
        FROM
            users
        WHERE
            userID =$id
        ";
    
        $result = $con->query($statement) or die ($con->error);
    
        returnUserJSON($result);
        
        $con->close();
    }

    return $result;
}

function selectUserByEmail($email) {
    global $con;

    if($con==null){
        sendResponse(500,$con,'Server Connection Error');
    }else{
        $statement = "
        SELECT 
            userID, firstName, lastName, email, password, access
        FROM
            users
        WHERE
            email = '$email'
        ";

        $result = $con->query($statement) or die ($con->error);
    
        returnUserJSON($result);
        
        
    }

    return $result;
}

function isLoginSuccess($email, $password) {
    global $con;

    $email = $_POST['email'];
    $password = $_POST['password'];

    $statement = "SELECT * FROM users WHERE email = '$email'";
    
    $user = $con->query($statement) or die ($con->error);
    $row = $user -> fetch_assoc();
    $total = $user->num_rows;
       
    if ($total > 0) {
    
        $db_password = $row['password']; 

        if(password_verify($password, $db_password)) {
            return true;
        } else{
                return false;
            }
    } else {
        return false;
    }

    $con->close();
    return false;
}

function insertUser(array $user) {
    global $con;

    if($con==null){
        sendResponse(500,$con,'Server Connection Error');
    }else{
        $statement = "
        INSERT INTO users 
            (firstName, lastName, email, password, access)
        VALUES
            (?,?,?,?,?)
        ";

        $stmt = $con->prepare($statement);

        $stmt->bind_param('sssss', $user[0], $user[1], $user[2], $user[3], $user[4]);
    
        $result = $stmt->execute() or die ($con->error);
    

        //check if user list available 
        if ($result) {
            sendResponse(200, $result , 'User Added Successful.');
        } else {
            sendResponse(404, [] ,'User Insert Failed');
        }
        //close connection
        $con->close();
    }
}

function updateUser($id, array $user) {
    global $con;

    if(con == null) {
        sendResponse(500, $con, 'Server Connection Error');
    } else {
        $statement = "
        UPDATE `users` SET 
        `firstName` = '?',
        `lastName` = '?',
        `email` = '?', 
        `password` = '?', 
        `access` = '?' 
        WHERE `userID` = $id";

        $stmt = $con->prepare($statement);
        $stmt->bind_param($user->firstName, $user->lastName, $user->email, $user->password, $user->access);
        
        $result = $stmt->execute() or die ($con->error);

        //check if user list available 
        if ($result) {
            sendResponse(200, $result , 'User Updated Successful.');
        } else {
            sendResponse(404, [] ,'User Update Failed');
        }
        //close connection
        $con->close();
    }
}

function deleteUsers() {
    global $con;

    if(con == null) {
        sendResponse(500, $con, 'Server Connection Error');
    } else {
        $statement = "DELETE FROM users";

        $result = $con->query($statement) or die ($con->error);

        //check if user list available 
        if ($result) {
            sendResponse(200, $result , 'All Users Delete Successful.');
        } else {
            sendResponse(404, [] ,'All Users Delete Failed');
        }
        //close connection
        $con->close();
    }
}

function deleteUser($id) {
    global $con;

    if(con == null) {
        sendResponse(500, $con, 'Server Connection Error');
    } else {
        $statement = "
        DELETE FROM users
        WHERE userID= $id";

        $result = $con->query($statement) or die ($con->error);

        //check if user list available 
        if ($result) {
            sendResponse(200, $result , 'All Users Delete Successful.');
        } else {
            sendResponse(404, [] ,'All Users Delete Failed');
        }
        //close connection
        $con->close();
    }


}

function returnUserJSON($result) {
    if ($result->num_rows > 0) {
        $users=array();
        while($row = $result->fetch_assoc()) {
            $user=array(
                "id" =>  $row["userID"],
                "lastName" => $row["firstName"],
                "firstName" => $row["lastName"],
                "email" => $row["email"],
                "password" => $row["password"],
                "access" => $row["access"],
            );
            array_push($users,$user);
        }
        sendResponse(200,$users,'User List');
    } else {
        sendResponse(404,[],'User not available');
    }
}

function sendResponse($resp_code,$data,$message){
    json_encode(array('code'=>$resp_code,'message'=>$message,'data'=>$data));
}

// $arr = array();
// array_push($arr,'abc','abc','abc','abc','user');

// insertUser($arr);
