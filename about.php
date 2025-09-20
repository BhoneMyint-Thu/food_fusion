<?php

if (!isset($_SESSION)) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>About Us - FoodFusion</title>
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/about.css">
</head>

<body class="about-page">
    <?php include("./includes/header.php"); ?>

    <!-- Hero Section -->
    <section class="about-hero">
        <div class="overlay">
            <h1>About <span class="brand-name">FoodFusion</span></h1>
            <p>Who we are & what we do</p>
        </div>
    </section>

    <!-- Mission Section -->
    <section class="about-mission">
        <h2>Our Mission</h2>
        <p>
            At FoodFusion, our mission is to bring food lovers together to explore, share,
            and celebrate culinary creativity while promoting sustainable cooking practices.
        </p>
    </section>

    <!-- Philosophy Section -->
    <section class="about-philosophy">
        <h2>Our Philosophy</h2>
        <p>
            We believe cooking should be fun, inclusive, and inspiring.
            Whether you’re a home cook or a professional, FoodFusion provides a space
            to discover new recipes, exchange ideas, and learn from each other.
        </p>
    </section>

    <!-- Values Section -->
    <section class="about-values">
        <h2>Our Core Values</h2>
        <div class="values-grid">
            <div class="value-card">
                <h3>Creativity</h3>
                <p>We encourage innovation in the kitchen and new culinary ideas.</p>
            </div>
            <div class="value-card">
                <h3>Community</h3>
                <p>We connect food enthusiasts from all backgrounds to share experiences.</p>
            </div>
            <div class="value-card">
                <h3>Sustainability</h3>
                <p>We promote eco-friendly and responsible cooking practices.</p>
            </div>
            <div class="value-card">
                <h3>Sharing</h3>
                <p>We believe food tastes better when it’s shared with others.</p>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section class="about-team">
        <h2>Meet the Team</h2>
        <div class="team-grid">
            <div class="team-member">
                <img src="./assets/images/ceo.png" alt="Team Member">
                <h3>Satoru Bhone Myint</h3>
                <p>Founder & CEO</p>
            </div>
            <div class="team-member">
                <img src="./assets/images/avatar1.jpeg" alt="Team Member">
                <h3>Mark Chen</h3>
                <p>Head of Recipes</p>
            </div>
            <div class="team-member">
                <img src="./assets/images/avatar2.jpeg" alt="Team Member">
                <h3>Angela Swift</h3>
                <p>Community Manager</p>
            </div>
        </div>
    </section>
    <script src="./assets/js/cookie.js"></script>
    <?php include("./includes/footer.php"); ?>
    <?php include("./includes/cookie_consent.php"); ?>
</body>

</html>