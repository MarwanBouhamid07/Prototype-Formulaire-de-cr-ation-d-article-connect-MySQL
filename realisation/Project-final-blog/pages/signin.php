<?php
require_once "../config/database.php";
if(session_status() === PHP_SESSION_NONE){
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sign in</title>
    <link rel="stylesheet" href="../assets/styles/login.css">
    <link rel="stylesheet" href="../assets/styles/signin.css">
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
    <section class="card-sigin card-login">
        <div class="loginform">
            <div class="logo">PI</div>
            <div class="siginTitle">
                <h2>Create an account</h2>
                <p>Sign up to get started with Project Insight.</p>
            </div>
            <form action="../actions/auth-sigin.php" method="post">
                <div class="group group-username">
                    <label for="username">Username</label>
                    <span class="pass-icon"><i class="fa-regular fa-envelope"></i></span>
                    <input type="text" placeholder="johndoe" id="username" name="username" required>
                </div>
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
                <div class="group">
                <div class="custom-select-container">
                    <label>Account Type</label>
                    <div class="select-box" id="selectBox">
                        <div class="selected-option">
                            <div class="icon-with-select">
                                <i class="fas fa-shield-alt"></i> <span>Simple User (Read & Comment)</span>
                            </div>
                            <i class="fas fa-chevron-down arrow"></i>
                        </div>
                        <ul class="options-list" id="optionsList">
                            <li data-value="user" class="active">Simple User (Read & Comment)</li>
                            <li data-value="author">Author (Write & Publish)</li>
                        </ul>
                    </div>
                    <input type="hidden" name="account_type" id="accountTypeInput" value="user">
                </div>
                </div>
                <button type="submit">Create acount <i class="fa-solid fa-arrow-right"></i></button>
            </form>
            <div class="hasnt-acount">Already have an account? <a href="login.php">Sign in</a></div>
        </div>
        <div class="welcome">
            <h1>Join Project Insight</h1>
            <p>Start sharing your own insights and be part of our growing tech community.</p>
        </div>
    </section>
    <script>
        const selectBox = document.getElementById('selectBox');
        const optionsList = document.getElementById('optionsList');
        const input = document.getElementById('accountTypeInput');

        selectBox.addEventListener('click', () => {
            selectBox.classList.toggle('open');
        });

        optionsList.querySelectorAll('li').forEach(option => {
            option.addEventListener('click', (e) => {
                const text = e.target.innerText;
                const value = e.target.getAttribute('data-value');

                selectBox.querySelector('span').innerText = text;
                input.value = value;

                optionsList.querySelectorAll('li').forEach(li => li.classList.remove('active'));
                e.target.classList.add('active');
            });
        });

        window.addEventListener('click', (e) => {
            if (!selectBox.contains(e.target)) {
                selectBox.classList.remove('open');
            }
        });
    </script>
</body>

</html>