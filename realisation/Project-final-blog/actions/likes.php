<?php
session_start();
require_once "../includes/function-articles.php";


if(isset($_POST['like'])){
    if(!isset($_SESSION['user_id'])){
        header("Location: ../pages/login.php");
        exit();
    }

    $article_id = $_POST['article_id'];
    $user_id = $_SESSION['user_id'];

    $db = new Database();
    $conn = $db->getconnection();

    // Check if already liked
    $check_query = "SELECT * FROM likes WHERE article_id = :article_id AND user_id = :user_id";
    $check_stmt = $conn->prepare($check_query);
    $check_stmt->execute([':article_id' => $article_id, ':user_id' => $user_id]);
    
    if ($check_stmt->fetch()) {
        // Unlike
        $query = "DELETE FROM likes WHERE article_id = :article_id AND user_id = :user_id";
    } else {
        // Like
        $query = "INSERT INTO likes (article_id, user_id) VALUES (:article_id, :user_id)";
    }
    
    $stmt = $conn->prepare($query);
    $stmt->execute([':article_id' => $article_id, ':user_id' => $user_id]);
    
    header("Location: ../pages/detail.php?id=" . $article_id);
    exit();
}