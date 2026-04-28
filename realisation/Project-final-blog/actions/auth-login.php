<?php
require_once "../config/database.php";
session_start();

$connect = new Database();

$pdo = $connect->getconnection();


if($_SERVER["REQUEST_METHOD"]== 'POST'){

$email =filter_var($_POST['email'],FILTER_VALIDATE_EMAIL) ?? '';
$password = $_POST['password'] ?? '';
// $errors = [];
if(empty($email) || empty($password)){
    // $errors[] = 'You must fill the fields';
    $_SESSION['error'] = 'You must fill the fields';
    header("Location: ../pages/login.php");
    exit();
}

$stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
$stmt->execute([':email' => $email]);
$user = $stmt->fetch();

        if ($user && $password == $user['password']) {

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            setcookie("user_id", $user['id'], time() + 30000000, "/");
                        
            header("Location: ../pages/home.php");
            exit();
        } else {
            
            // $errors[] = "Invalid username or password.";
            $_SESSION['error'] ="Invalid username or password.";
            header("Location: ../pages/login.php");
            exit();
        }



}




?>