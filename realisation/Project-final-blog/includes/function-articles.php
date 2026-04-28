<?php
require_once __DIR__ . '/../config/database.php';
// require_once "../config/database.php";

function getArticlesHome($page = 1, $limit = 6, $sort = 'newset', $id = null, $search = null)
{
    $db = new Database();
    $conn = $db->getconnection();

    // Determine sort direction
    $direction = ($sort === 'oldest') ? 'ASC' : 'DESC';
    $offset = ($page - 1) * $limit;

    // Base query with joins
    $query = "SELECT a.*, c.name as category_name, u.username as author_name 
              FROM articles a 
              LEFT JOIN categories c ON a.category_id = c.id 
              LEFT JOIN users u ON a.author_id = u.id 
              WHERE a.status = 'published'";

    // Filter by author if ID is provided
    if ($id !== null) {
        $query .= " AND a.author_id = :id ";
    }

    // NEW: Search filter for title, content, or excerpt
    if ($search !== null && $search !== '') {
        $query .= " AND (a.title LIKE :search OR u.username LIKE :search OR a.content LIKE :search OR a.excerpt LIKE :search) ";
    }

    // Sorting and Pagination
    $query .= " ORDER BY a.created_at $direction LIMIT :limit OFFSET :offset";

    $stmt = $conn->prepare($query);

    // Bind basic parameters
    $stmt->bindValue(':limit', (int) $limit, PDO::PARAM_INT);
    $stmt->bindValue(':offset', (int) $offset, PDO::PARAM_INT);

    // Bind author ID if exists
    if ($id !== null) {
        $stmt->bindValue(':id', (int) $id, PDO::PARAM_INT);
    }

    // Bind search term with wildcards if exists
    if ($search !== null && $search !== '') {
        $searchTerm = "%$search%";
        $stmt->bindValue(':search', $searchTerm, PDO::PARAM_STR);
    }

    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function categoriesCount()
{
    $db = new Database();
    $conn = $db->getconnection();
    $cat_query = "SELECT c.id , c.name, COUNT(a.id) as count 
              FROM categories c 
              LEFT JOIN articles a ON c.id = a.category_id 
              GROUP BY c.id";

    $stmt = $conn->query($cat_query);
    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $categories;
}


//read the last article posting in the blog
function todayPost()
{
    $db = new Database();
    $conn = $db->getconnection();
    $query = "SELECT a.*, c.name as category_name, u.username as author_name 
          FROM articles a 
          LEFT JOIN categories c ON a.category_id = c.id 
          LEFT JOIN users u ON a.author_id = u.id 
          ORDER BY a.created_at DESC 
          LIMIT 1";

    $stmt = $conn->query($query);
    $latest_article = $stmt->fetch(PDO::FETCH_ASSOC);
    return $latest_article;

}
//function of check in the login 
function check_login()
{
    if (!isset($_SESSION['user_id'])) {
        header("Location: ../pages/login.php");
        exit();
    }
}
//funtion of delete articles
function delete_article($id)
{
    $db = new Database();
    $conn = $db->getconnection();
    $sql = "DELETE FROM articles WHERE id = :id;";

    $stmt = $conn->prepare($sql);
    $stmt->execute(['id' => $id]);
}

//count all comments of the user 
function countComents($author_id)
{
    $db = new Database();
    $conn = $db->getconnection();

    $query = "SELECT COUNT(c.id) as total_comments 
              FROM comments c 
              JOIN articles a ON c.article_id = a.id 
              WHERE a.author_id = :author_id";

    $stmt = $conn->prepare($query);
    $stmt->bindValue(':author_id', (int) $author_id, PDO::PARAM_INT);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result['total_comments'] ?? 0;
}

//get the total veiws of the user
function Totalveiws($author_id)
{
    $db = new Database();
    $conn = $db->getconnection();

    $query = "SELECT SUM(views_count) as total_views FROM articles
              WHERE author_id = :author_id";

    $stmt = $conn->prepare($query);
    $stmt->bindValue(':author_id', (int) $author_id, PDO::PARAM_INT);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result['total_views'] ?? 0;
}

//count the total public araticles in the blog of the user
function TotalActiveArticles($author_id)
{
    $db = new Database();
    $conn = $db->getconnection();

    $query = "SELECT COUNT(*) as total_active_articles 
              FROM articles
              WHERE author_id = :author_id AND status = 'published'";

    $stmt = $conn->prepare($query);
    $stmt->bindValue(':author_id', (int) $author_id, PDO::PARAM_INT);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result['total_active_articles'] ?? 0;
}


//get article by id 


function getartilceforDetail($id){
    $db = new Database();
    $conn = $db->getconnection($id);
    $query = "SELECT a.*, c.name as category_name, u.username as author_name 
              FROM articles a 
              LEFT JOIN categories c ON a.category_id = c.id 
              LEFT JOIN users u ON a.author_id = u.id 
              WHERE a.status = 'published' AND a.id =:id";
    $stmt = $conn->prepare($query);
    $stmt->execute([':id'=> $id]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

//get comments 
function countComments($article_id)
{
    $db = new Database();
    $conn = $db->getconnection();
    $query = 'SELECT COUNT(*) as total_comments FROM comments WHERE article_id =:article_id';
    $stmt = $conn->prepare($query);
    $stmt->execute([':article_id'=> $article_id]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['total_comments'] ?? 0;
}

//get comments 
function getComments($article_id)
{
    $db = new Database();
    $conn = $db->getconnection();
    $query = 'SELECT * FROM comments WHERE article_id =:article_id';
    $stmt = $conn->prepare($query);
    $stmt->execute([':article_id'=> $article_id]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['total_comments'] ?? 0;
}

//likes function
function countLikes($article_id)
{
    $db = new Database();
    $conn = $db->getconnection();
    $query = 'SELECT COUNT(*) as total_likes FROM likes WHERE article_id =:article_id';
    $stmt = $conn->prepare($query);
    $stmt->execute([':article_id'=> $article_id]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['total_likes'] ?? 0;
}

// Check if user liked article
function hasUserLiked($article_id, $user_id)
{
    $db = new Database();
    $conn = $db->getconnection();
    $query = 'SELECT COUNT(*) FROM likes WHERE article_id = :article_id AND user_id = :user_id';
    $stmt = $conn->prepare($query);
    $stmt->execute([':article_id' => $article_id, ':user_id' => $user_id]);
    return $stmt->fetchColumn() > 0;
}

