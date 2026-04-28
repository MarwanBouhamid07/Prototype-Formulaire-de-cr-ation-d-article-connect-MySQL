<?php
require_once "../includes/function-articles.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

check_login();
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$sort = $_GET['sort'] ?? 'newset';
$articles = getArticlesHome($currentPage, 4, $sort);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artilces</title>
    <link rel="stylesheet" href="../assets/styles/header.css">
    <link rel="stylesheet" href="../assets/styles/articles.css">
    <script src="https://kit.fontawesome.com/8f8b4a4f39.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php include "../includes/header.php" ?>
    <main>

        <section class="header-card">
            <div class="top-row">
                <span class="badge">CATEGORY ARCHIVE</span>
            </div>

            <div class="main-content">
                <div class="text-side">
                    <h1>Category: <span>Articles</span></h1>
                    <p>Explore our latest articles, tutorials, and insights in the articles space. Stay updated with cutting-edge trends and best practices.</p>
                </div>

                <div class="filter-side">
                    <div class="sort-container">
                        <span class="sort-label">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="4" y1="21" x2="4" y2="14"></line>
                                <line x1="4" y1="10" x2="4" y2="3"></line>
                                <line x1="12" y1="21" x2="12" y2="12"></line>
                                <line x1="12" y1="8" x2="12" y2="3"></line>
                                <line x1="20" y1="21" x2="20" y2="16"></line>
                                <line x1="20" y1="12" x2="20" y2="3"></line>
                                <line x1="1" y1="14" x2="7" y2="14"></line>
                                <line x1="9" y1="8" x2="15" y2="8"></line>
                                <line x1="17" y1="16" x2="23" y2="16"></line>
                            </svg>
                            Sort by:
                        </span>
                        <select class="sort-dropdown" onchange="location = this.value;">
                            <option value="articles.php?page=1&sort=newest" <?php echo (!isset($_GET['sort']) || $_GET['sort'] == 'newest') ? 'selected' : ''; ?>>Newest</option>
                            <option value="articles.php?page=1&sort=oldest" <?php echo (isset($_GET['sort']) && $_GET['sort'] == 'oldest') ? 'selected' : ''; ?>>Oldest</option>
                        </select>

                    </div>
                </div>
            </div>
        </section>

        <div class="container">

            <section class="articles-grid">
                <div class="cards-container">
                    <?php if (empty($articles)): ?>
                        <p>No articles found.</p>
                    <?php else: ?>
                        <?php foreach ($articles as $article): ?>
                            <article class="post-card"  onclick="window.location.href='detail.php?id=<?php echo $article['id']; ?>'">
                                <div class="post-image">
                                    <span class="badge"><?php echo htmlspecialchars($article['category_name'] ?? 'General'); ?></span>
                                    <img src="<?php echo htmlspecialchars($article['featured_image_url']); ?>" alt="<?php echo htmlspecialchars($article['title']); ?>">
                                </div>

                                <div class="post-content">
                                    <time><i class="fa-regular fa-calendar"></i> <?php echo date('M d, Y', strtotime($article['created_at'])); ?></time>

                                    <h3 class="card-title"> <?php echo htmlspecialchars($article['title']); ?></h3>

                                    <div class="author-info">
                                        <div class="name">
                                            <div class="prfile"><?php echo strtoupper(substr($article['author_name'], 0, 1)); ?></div>
                                            <span><?php echo htmlspecialchars($article['author_name']); ?></span>
                                        </div>
                                        <div class="icon-left">
                                            <a href="detail.php?id=<?php echo $article['id']; ?>">
                                                <i class="fa-solid fa-arrow-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </section>
            <div class="pagination">
                <a href="articles.php?page=<?php echo max(1, $currentPage - 1); ?>" class="arrow prev <?php echo ($currentPage <= 1) ? 'disabled' : ''; ?>">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="15 18 9 12 15 6"></polyline>
                    </svg>
                </a>

                <a href="articles.php?page=1" class="page-number <?php echo ($currentPage == 1) ? 'active' : ''; ?>">1</a>
                <a href="articles.php?page=2" class="page-number <?php echo ($currentPage == 2) ? 'active' : ''; ?>">2</a>
                <a href="articles.php?page=3" class="page-number <?php echo ($currentPage == 3) ? 'active' : ''; ?>">3</a>

                <span class="dots">...</span>

                <a href="articles.php?page=8" class="page-number <?php echo ($currentPage == 8) ? 'active' : ''; ?>">8</a>

                <a href="articles.php?page=<?php echo $currentPage + 1; ?>" class="arrow next">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="9 18 15 12 9 6"></polyline>
                    </svg>
                </a>
            </div>

    </main>

    <?php include "../includes/footer.php" ?>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const pageNumbers = document.querySelectorAll('.page-number');
            const nextArrow = document.querySelector('.arrow.next');

            const prevArrow = document.querySelector('.arrow.prev');

            pageNumbers.forEach(number => {
                number.addEventListener('click', (e) => {
                    const currentActive = document.querySelector('.page-number.active');
                    if (currentActive) {
                        currentActive.classList.remove('active');
                    }

                    // Add 'active' class to the clicked element
                    number.classList.add('active');

                    // Log the current page for debugging purposes
                    console.log("Loading data for page: " + number.innerText);

                    // Optional: Call updateArrows function to handle button states
                    updateArrows(number.innerText);
                });
            });



            function updateArrows(page) {
                // Disable previous arrow if on the first page
                if (page === "1") {
                    prevArrow.classList.add('disabled');
                } else {
                    prevArrow.classList.remove('disabled');
                }
            }
        });
    </script>
        <script src="../assets/scripts/script.js"></script>

</body>

</html>