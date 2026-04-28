<?php
session_start();
?>
    <header>
        <div class="group-style">
        <div class="group-LNM-L">
            <div class="logo-project-name" id="logo-project-name">
                <div class="logo">PI</div>
                <div class="project-name">Project Insight</div>
            </div>
            <nav>
                <a href="home.php">Home</a>
                <a href="articles.php">Article</a>
                <a href="about.php">About us</a>
            </nav>
        </div>
        <div class="buttons-header">
            <div class="profile-head">
                <div class="profile-user"><i class="fa-regular fa-user"></i></div>
                <div class="group-profile">
                    <div class="username"><?php echo $_SESSION['user'];?></div>
                    <div class="role"><?php echo $_SESSION['role'];?></div>
                </div>
            </div>
            <a href="login.php">Login in</a>
            <?php if($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'author' ):?>
            <div class="admin-button" id="admin-page">Admin</div>
            <?php endif;?>
            <div class="explore">Explore</div>
        </div>
        </div>

    </header>
