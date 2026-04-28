<?php
require_once "../config/database.php";
require_once "../includes/funcitons-users.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $role = $_POST['account_type'] ?? 'user';

    if (empty($username) || empty($email) || empty($password)) {
        $_SESSION['error'] = 'All fields are required';
        header("Location: ../pages/signin.php");
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = 'Invalid email format';
        header("Location: ../pages/signin.php");
        exit();
    }

    $db = new Database();
    $pdo = $db->getconnection();
    
    $checkEmail = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $checkEmail->execute([$email]);
    if ($checkEmail->fetch()) {
        $_SESSION['error'] = 'Email already exists';
        header("Location: ../pages/signin.php");
        exit();
    }

    try {

        $stmt = $pdo->prepare("INSERT INTO users (username, email, role, created_at, password) VALUES (:user, :email, :role, NOW(), :pass)");
        
        $stmt->execute([
            ':user'  => $username,
            ':email' => $email,
            ':role'  => $role,
            ':pass'  => $password
        ]);

        $_SESSION['success'] = "Account added successfully!";
        header("Location: ../pages/login.php");
        exit();

    } catch (PDOException $e) {
        $_SESSION['error'] = "Database Error: " . $e->getMessage();
        header("Location: ../pages/signin.php");
        exit();
    }
}
?>