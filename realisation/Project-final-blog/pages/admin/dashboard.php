<?php
require_once "../../includes/function-articles.php";
session_start();
$currentPage = 1;


$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($currentPage < 1) $currentPage = 1;

if (isset($_GET['id-delete'])) {
    $idDelete = (int)$_GET['id-delete'];

    if ($idDelete > 0) {
        delete_article($idDelete);

        header("Location: dashboard.php");
        exit;
    }
}



$sort = $_GET['sort'] ?? 'newset';
$id = $_COOKIE["user_id"];

$total_comments = countComents($id);
$search = isset($_GET['query']) ? $_GET['query'] : null;
$articles = getArticlesHome($currentPage, 5, $sort, $id, $search);
$total_veiws = Totalveiws($id);
$total_active_articles = TotalActivearticles($id);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../../assets/styles/sidebare.css">
    <link rel="stylesheet" href="../../assets/styles/dashboard.css">
    <script src="https://kit.fontawesome.com/8f8b4a4f39.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php include "../../includes/sidebareAdmin.php" ?>

    <main>
        <header>
            <div class="group">
                <h2>Dashboard Overview</h3>
                    <p>Manage your blog content and monitor performance metrics.</p>
            </div>
            <button id="new-post" class="add-post"><i class="fa-solid fa-plus"></i> New Post</button>
        </header>
        <div class="stats-container">
            <div class="stat-card">
                <div class="stat-info">
                    <span class="stat-label">Total Views</span>
                    <div class="stat-value-row">
                        <span class="stat-number"><?php echo $total_veiws ?></span>
                    </div>
                </div>
                <div class="stat-icon icon-blue">
                    <i class="fa-regular fa-eye"></i>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-info">
                    <span class="stat-label">Active Posts</span>
                    <div class="stat-value-row">
                        <span class="stat-number"><?php echo  $total_active_articles ?></span>
                    </div>
                </div>
                <div class="stat-icon icon-green">
                    <i class="fa-regular fa-file-lines"></i>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-info">
                    <span class="stat-label">Total Comments</span>
                    <div class="stat-value-row">
                        <span class="stat-number"><?php echo $total_comments ?></span>

                    </div>
                </div>
                <div class="stat-icon icon-purple">
                    <i class="fa-regular fa-comment-dots"></i>
                </div>
            </div>
        </div>
        <section class="table-card" style="margin-top:20px;">
            <div class="table-header">
                <h2>Recent Articles</h2>
                <div class="search-box">
                    <form method="GET" class="search-box">
                        <input type="text" name="query" placeholder="Search articles..."
                            value="<?php echo isset($_GET['query']) ? htmlspecialchars($_GET['query']) : ''; ?>">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <button type="submit"></button>
                    </form>
                </div>
            </div>

            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>TITLE</th>
                            <th>CATEGORY</th>
                            <th>VIEWS</th>
                            <th>STATUS</th>
                            <th>DATE</th>
                            <th>ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($articles)): ?>
                            <p>No articles found.</p>
                        <?php else: ?>
                            <?php foreach ($articles as $article): ?>
                                <tr>
                                    <td class="article-title"><?php echo htmlspecialchars($article['title']); ?></td>
                                    <td><span class="cat-badge"><?php echo htmlspecialchars($article['category_name'] ?? 'General'); ?></span></td>
                                    <td class="views-cell"><i class="fa-regular fa-eye"></i><?php echo htmlspecialchars($article['views_count']); ?> </td>
                                    <td><span class="status-badge status-published"><?php echo htmlspecialchars($article['status']) ?></span></td>
                                    <td><?php echo date('M d, Y', strtotime($article['created_at'])); ?></td>
                                    <td class="actions">
                                        <a href="dashboard.php?id=<?php echo $article['id']; ?> " class="btn-edit"><i class="fa-regular fa-pen-to-square"></i></a>
                                        <a href="dashboard.php?id-delete=<?php echo $article['id']; ?> " class="btn-delete"><i class="fa-regular fa-trash-can"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>


                    </tbody>
                </table>
            </div>

            <div class="table-footer">
                <p>Showing 1 to 5 of 128 entries</p>
                <div class="footer-btns">
                    <a href="dashboard.php?page=<?php echo $currentPage - 1; ?>" class="btn-nav">Previous</a>
                    <a href="dashboard.php?page=<?php echo $currentPage + 1; ?>" class="btn-nav">Next</a>
                </div>
            </div>
        </section>
    </main>


    <div class="footer-btns">
        <button class="btn-nav">Previous</button>
        <button class="btn-nav">Next</button>
    </div>
    </div>
    </section>
    </main>

    <script>
        const newPost = document.getElementById('new-post');

        newPost.onclick= function (){
            window.open("create_articles.php","_self");
        }
    </script>
</body>

</html>