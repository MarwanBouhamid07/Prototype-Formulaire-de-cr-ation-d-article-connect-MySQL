<?php
require_once '../config/database.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_post'])) {
    $db = new Database();
    $conn = $db->getconnection();

    $title       = $_POST['title'];
    $content     = $_POST['content'];
    $category_id = $_POST['category_id'];
    $tags        = $_POST['tags'];
    $excerpt     = $_POST['excerpt'];
    $author_id   = $_COOKIE['user_id'];
    $now         = date('Y-m-d H:i:s');
    
    $image_name  = null; 

    if (isset($_FILES['cover_image']) && $_FILES['cover_image']['error'] == 0) {
        $upload_dir = "../uploads/";
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        $file_ext = pathinfo($_FILES["cover_image"]["name"], PATHINFO_EXTENSION);
        $image_name = "post_" . time() . "." . $file_ext; 
        $target_path = $upload_dir . $image_name;
        move_uploaded_file($_FILES["cover_image"]["tmp_name"], $target_path);
    }

    try {
       
        $sql = "INSERT INTO articles (title, excerpt, content, category_id, author_id, featured_image_url, status, published_at, created_at, updated_at) 
                VALUES (:title, :excerpt, :content, :cat_id, :author_id, :image, 'published', :pub_at, :created, :updated)";
        
        $stmt = $conn->prepare($sql);
        
       
        $result = $stmt->execute([
            ':title'     => $title,
            ':excerpt'   => $excerpt,
            ':content'   => $content,
            ':cat_id'    => $category_id, 
            ':author_id' => $author_id,   
            ':image'     => $target_path,
            ':pub_at'    => $now,
            ':created'   => $now,
            ':updated'   => $now  
        ]);

        if ($result) {
            header("Location: ../pages/admin/dashboard.php?msg=post_created");
            exit();
        }
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
}