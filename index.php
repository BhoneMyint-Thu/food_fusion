
<?php
include './includes/db_connect.php';
if (!isset($_SESSION)) {
    session_start();
}
// Fetch 6 featured recipes
$recipesSql = "
    SELECT r.recipe_id, r.title, r.description, r.cuisine_type, r.cover_img_src, r.difficulty, r.created_at, u.first_name, u.last_name
    FROM recipes r
    LEFT JOIN users u ON r.user_id = u.user_id
    WHERE r.is_featured = 1
    ORDER BY r.created_at DESC
    LIMIT 6
";
$recipesResult = $conn->query($recipesSql);
$recipes = [];
if ($recipesResult && $recipesResult->num_rows > 0) {
    while ($row = $recipesResult->fetch_assoc()) {
        $recipes[] = $row;
    }
}

$eventsSql = "SELECT * FROM events WHERE event_date >= NOW() ORDER BY event_date ASC;";
$eventResult = $conn->query($eventsSql);
$events = [];
if ($eventResult && $eventResult->num_rows > 0) {
    while ($erow = $eventResult->fetch_assoc()) {
        $events[] = $erow;
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>FoodFusion - Home</title>
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/home.css">
</head>

<body class="home-page">

    <?php include("./includes/header.php"); ?>
    <div class="main-container">
        <section class="intro-hero">
            <div class="intro-overlay">
                <div class="intro-content">
                    <h1>FoodFusion</h1>
                    <p>Bringing food lovers together to explore, share, and celebrate culinary creativity.
                        Discover recipes, join our community, and learn sustainable cooking practices.</p>
                    <a href="recipes.php" class="btn-primary">Explore Recipes</a>
                    <button id="sign-up-now-btn" class="btn-primary">Join Us</button>
                </div>
            </div>
        </section>

        <!-- Featured Recipes / News Feed -->
        <section class="news-feed">
            <div class="container">
                <h2 class="section-title">Featured Recipes</h2>
                <p class="section-subtitle">Discover the latest culinary trends and tasty ideas from FoodFusion.</p>

                <div class="recipe-grid">
                    <?php if (!empty($recipes)): ?>
                        <?php foreach ($recipes as $recipe): ?>
                            <div class="recipe-card">
                                <img src=<?= htmlspecialchars($recipe['cover_img_src']) ?> alt="<?= htmlspecialchars($recipe['title']) ?>">
                                <div class="card-content">
                                    <h3><?= htmlspecialchars($recipe['title']) ?></h3>
                                    <p><?= htmlspecialchars(substr($recipe['description'], 0, 80)) ?>...</p>
                                    <small>
                                        <?= htmlspecialchars($recipe['cuisine_type']) ?> |
                                        <?= htmlspecialchars($recipe['difficulty']) ?>
                                        <br>
                                        by <?= htmlspecialchars($recipe['first_name'] . ' ' . $recipe['last_name']) ?>
                                    </small>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>No recipes available yet.</p>
                    <?php endif; ?>
                </div>


            </div>


        </section>

        <section class="upcoming-events">
            <div class="container">
                <h2 class="section-title">Upcoming Events</h2>
                <p class="section-subtitle">Join our upcoming cooking events and workshops to learn new recipes, sharpen your culinary skills, and meet fellow food enthusiasts.</p>

                <div class="carousel">
                    <div class="carousel-track">
                        <?php if (!empty($events)): ?>
                            <?php foreach ($events as $event): ?>

                                <div class="carousel-item">
                                    <img src=<?= htmlspecialchars($event['cover_img_src']) ?> alt="<?= htmlspecialchars($recipe['title']) ?>">
                                    <h3>"<?= htmlspecialchars($event['title']) ?>"</h3>
                                    <p><?= htmlspecialchars(substr($event['description'], 0, 80)) ?>...</p>
                                    <small>
                                        <?= htmlspecialchars($event['location']) ?> |
                                        <?= htmlspecialchars($event['event_date']) ?>
                                    </small>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p>No upcoming events yet.</p>
                        <?php endif; ?>
                    </div>

                    <button class="prev">&#10094;</button>
                    <button class="next">&#10095;</button>
                </div>


            </div>


        </section>









        <?php include("./includes/footer.php"); ?>
    </div>
    <script src="./assets/js/home.js"></script>
    <script src="./assets/js/cookie.js"></script>

    <!-- Join Us Modal -->
    <div class="modal-backdrop" id="join-modal">
        <div class="modal">
            <span class="close-btn" id="close-modal">&times;</span>
            <h2>Join FoodFusion</h2>
            <form method="POST" action="auth/register.php">
                <div class="form-control">
                    <label for="first_name">First Name</label>
                    <input type="text" name="first_name" required>
                </div>
                <div class="form-control">
                    <label for="last_name">Last Name</label>
                    <input type="text" name="last_name" required>
                </div>
                <div class="form-control">
                    <label for="email">Email</label>
                    <input type="email" name="email" required>
                </div>
                <div class="form-control">
                    <label for="password">Password</label>
                    <input type="password" name="password" required>
                </div>
                <div class="form-control">
                    <label for="confirm_password">Confirm Password</label>
                    <input type="password" name="confirm_password" required>
                </div>
                <div class="btn-wrapper">
                    <button type="submit" class="btn-submit">Register</button>
                </div>
            </form>
        </div>
    </div>
    <?php include("./includes/cookie_consent.php"); ?>



</body>

</html>