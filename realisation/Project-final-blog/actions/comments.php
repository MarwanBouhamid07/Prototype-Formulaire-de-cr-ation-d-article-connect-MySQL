<?php
require_once "../config/database.php";
require_once "../includes/funcitons-users.php";
session_start();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $message = $_POST["message"];
    $article_id = $_POST["article_id"];

    try {

        $db = new Database();
        $conn = $db->getconnection();
       $now = date("Y-m-d H:i:s");
        $sql = "INSERT INTO comments (content, article_id, user_id, created_at) 
                VALUES (:content, :article_id, :user_id, :created_at)";
        
        $stmt = $conn->prepare($sql);
        
       
        $result = $stmt->execute([
            ':content'   => $message,
            ':article_id'    => $article_id, 
            ':user_id'    => $_SESSION['user_id'],
            ':created_at'   => $now
        ]);

        if ($result) {
            header("Location: ../pages/detail.php?id=$article_id&msg=comment_created");
            exit();
        }
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }


}

