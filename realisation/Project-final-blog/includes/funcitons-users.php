<?php

require_once "../config/database.php";
//function of read users from the database
function getUsers(){
    $db = new Database();
    $conn =$db->getconnection();
    
    $query = "SELECT * FROM users";

    
    $stmt = $conn->query($query);
    $users =$stmt->fetchAll(PDO::FETCH_ASSOC);
    return $users;
}

//function of redirect to another page which you want with a message of status
function redirect_with_message($url, $message, $type = 'success') {
    $_SESSION['message'] = $message;
    $_SESSION['message_type'] = $type;
    header("Location: $url");
    exit();
}
