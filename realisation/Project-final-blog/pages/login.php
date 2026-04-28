<?php
require_once "../config/database.php";
require_once "../includes/function-articles.php";
// check_login();
if(session_status() === PHP_SESSION_NONE){
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../assets/styles/login.css">
    <script src="https://kit.fontawesome.com/8f8b4a4f39.js" crossorigin="anonymous"></script>
</head>
<body>
        <?php if (isset($_SESSION['error'])): ?>
        <div class="error" style="color: red; text-align: center;">
            <?php 
                echo $_SESSION['error']; 
                unset($_SESSION['error']);
            ?>
        </div>
        <?php endif; ?>
    <section class= "card-login">
        <div class="welcome">
            <h1>Welcome back to Project Insight</h1>
            <p>Continue exploring the latest insights, tutorials, and breakthroughs in modern tech.</p>
        </div>
        <div class="loginform">
            <div class="logo">PI</div>
            <div class="siginTitle">
                <h2>Sign in to your account</h2>
                <p>Enter your details to access your dashboard.</p>
            </div>
                <form action="../actions/auth-login.php" method="post">
                    <div class="group group-email">
                        <label for="email">Email</label>
                        <span class="pass-icon"><i class="fa-regular fa-envelope"></i></span>
                        <input type="email" placeholder="name@example.com" id="email" name="email" required>
                    </div>
                    <div class=" group group-pass">
                        <label for="pass">Password</label>
                        <span class="pass-icon"><i class="fa-solid fa-lock"></i></span>
                        <input type="password" placeholder="........" id="pass" name="password" required>
                    </div>
                    <button type="submit">Sign in <i class="fa-solid fa-arrow-right"></i></button>
                </form>
                <div class="hasnt-acount">Don't have an account? <a href="signin.php">Create an account</a></div>
        </div>
    </section>
</body>
</html>