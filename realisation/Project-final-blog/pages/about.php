<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <link rel="stylesheet" href="../assets/styles/header.css">
    <link rel="stylesheet" href="../assets/styles/about.css">
    <script src="https://kit.fontawesome.com/8f8b4a4f39.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php include "../includes/header.php"; ?>
    <main>
        <section class="about-card">
            <div class="icon-container">
                <i class="fa-solid fa-users"></i>
            </div>

            <h1 class="about-title">About Project Insight</h1>

            <div class="about-description">
                <p>
                    Project Insight is a modern tech blog dedicated to empowering developers, designers, and
                    technology enthusiasts with in-depth articles, tutorials, and insights on the latest trends in
                    software development.
                </p>
                <p>
                    Founded in 2024, we believe in making complex technical concepts accessible and sharing
                    knowledge that drives innovation forward.
                </p>
            </div>
        </section>
        <section class="values-section">
            <h2 class="section-title">Our Values</h2>

            <div class="values-grid">
                <div class="value-card">
                    <div class="icon-box blue-bg">
                        <i class="icon-target">◎</i>
                    </div>
                    <h3>Mission Driven</h3>
                    <p>We're committed to sharing cutting-edge insights and knowledge with the tech community.</p>
                </div>

                <div class="value-card">
                    <div class="icon-box yellow-bg">
                        <i class="icon-bolt">⚡</i>
                    </div>
                    <h3>Innovation First</h3>
                    <p>Constantly exploring new technologies and methodologies to stay ahead of the curve.</p>
                </div>

                <div class="value-card">
                    <div class="icon-box pink-bg">
                        <i class="icon-heart">♡</i>
                    </div>
                    <h3>Community Focused</h3>
                    <p>Building a vibrant community of developers, designers, and tech enthusiasts.</p>
                </div>

                <div class="value-card">
                    <div class="icon-box green-bg">
                        <i class="icon-users">👥</i>
                    </div>
                    <h3>Collaborative</h3>
                    <p>Fostering collaboration and knowledge sharing across diverse backgrounds and experiences.</p>
                </div>
            </div>
        </section>
        <!-- <div class="container"> -->
            <section class="team-section">
                <h2 class="title">Meet Our Team</h2>
                <div class="team-grid">
                    <div class="member-card">
                        <div class="avatar">MB</div>
                        <h3>Marwan Bouhamid</h3>
                        <p class="role">Founder & Editor-in-Chief</p>
                        <p class="desc">10+ years in tech journalism with a passion for frontend development.</p>
                    </div>

                </div>
            </section>

            <section class="stats-banner">
                <div class="stat-item">
                    <span class="stat-number">500+</span>
                    <span class="stat-label">Published Articles</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">50K+</span>
                    <span class="stat-label">Monthly Readers</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">100+</span>
                    <span class="stat-label">Contributors</span>
                </div>
            </section>
        <!-- </div> -->
    </main>
    <?php include "../includes/footer.php";?>

</body>

</html>