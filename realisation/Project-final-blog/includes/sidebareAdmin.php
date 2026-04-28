<?php 
// Get the current file name (e.g., dashboard.php)
$current_page = basename($_SERVER['SCRIPT_NAME']);
?>

<aside class="sidebar">
    <div class="sidebar-brand">
        <div class="logo-box">PI</div>
        <span class="brand-name">Admin View</span>
    </div>

    <div class="sidebar-user">
        <div class="user-avatar">
            <i class="fa-solid fa-user"></i>
        </div>
        <div class="user-details">
            <span class="user-name"><?php echo $_SESSION['user'];?></span>
             <?php if($_SESSION['role'] == 'admin'):?>
            <span class="user-role">Administrator</span>
            <?php elseif($_SESSION['role'] == 'author'):?>
                <span class="user-role">Author</span>
            <?php else: ?>
                <?php header("location:../home.php"); ?>
                <?php endif; ?>
        </div>
    </div>

    <nav class="sidebar-menu">
        <ul>
        <li class="<?php echo ($current_page == 'dashboard.php') ? 'active' : ''; ?>">
            <a href="dashboard.php">
                <i class="fa-solid fa-table-columns"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li class="<?php echo ($current_page == 'create_articles.php') ? 'active' : ''; ?>">
            <a href="create_articles.php">
                <i class="fa-regular fa-file-lines"></i>
                <span>New Post</span>
            </a>
        </li>

        <li class="<?php echo ($current_page == 'statistics.php') ? 'active' : ''; ?>">
            <a href="statistics.php">
                <i class="fa-solid fa-chart-simple"></i>
                <span>Statistics</span>
            </a>
        </li>

        <li class="<?php echo ($current_page == 'settings.php') ? 'active' : ''; ?>">
            <a href="settings.php">
                <i class="fa-solid fa-gear"></i>
                <span>Settings</span>
            </a>
        </li>
    </ul>
    </nav>

    <div class="sidebar-footer">
        <a href="../home.php">
            <i class="fa-solid fa-arrow-right-from-bracket"></i>
            <span>Back to Site</span>
        </a>
    </div>
</aside>