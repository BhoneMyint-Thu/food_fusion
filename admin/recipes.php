<?php
// admin/recipes.php
include '../includes/db_connect.php';
if (!isset($_SESSION)) session_start();

// --- Auth: require login + admin ---
if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit;
}
$user_id = (int)$_SESSION['user_id'];

$stmt = $conn->prepare("SELECT is_admin, first_name, last_name FROM users WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$userRow = $stmt->get_result()->fetch_assoc();
if (!$userRow || (int)$userRow['is_admin'] !== 1) {
    http_response_code(403);
    echo "Access denied. Admins only.";
    exit;
}

// --- Search handling ---
$search = trim($_GET['q'] ?? '');
$hasSearch = $search !== '';

// --- Fetch recipes (with optional search) ---
if ($hasSearch) {
    $like = '%' . $search . '%';
    $sql = "
        SELECT r.recipe_id, r.title, r.cuisine_type, r.dietary_preference, r.difficulty,
               r.is_featured, r.cover_img_src, r.created_at, u.first_name, u.last_name
        FROM recipes r
        LEFT JOIN users u ON r.user_id = u.user_id
        WHERE r.title LIKE ?
        ORDER BY r.created_at DESC
    ";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $like);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $sql = "
        SELECT r.recipe_id, r.title, r.cuisine_type, r.dietary_preference, r.difficulty,
               r.is_featured, r.cover_img_src, r.created_at, u.first_name, u.last_name
        FROM recipes r
        LEFT JOIN users u ON r.user_id = u.user_id
        ORDER BY r.created_at DESC
    ";
    $result = $conn->query($sql);
}

// total count for UI
$totalRow = $conn->query("SELECT COUNT(*) AS cnt FROM recipes")->fetch_assoc();
$totalRecipes = (int)$totalRow['cnt'];

// Helper: make safe image URL (resolves relative paths stored in DB)
function resolve_image_url_from_admin($rawPath)
{
    // if empty, return empty so caller can fallback
    if (empty($rawPath)) return '';

    // remove leading "./" or "/" to normalize
    $clean = preg_replace('#^\./#', '', $rawPath);
    $clean = preg_replace('#^\/#', '', $clean);

    // server path relative to admin folder: __DIR__ is /path/to/project/admin
    $serverPath = __DIR__ . '/../' . $clean;
    $urlPath = '../' . $clean; // URL to use from admin page

    if (file_exists($serverPath)) {
        return $urlPath;
    }

    // try alternative: sometimes paths were stored as '../assets/...' or '/assets/...' or 'assets/...'
    $altServer = __DIR__ . '/../' . ltrim($rawPath, './\\/');
    $altUrl = '../' . ltrim($rawPath, './\\/');
    if (file_exists($altServer)) {
        return $altUrl;
    }

    // Not found on server
    return '';
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Admin — Recipes | FoodFusion</title>
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <link rel="stylesheet" href="../assets/css/admin_recipes.css">
    <link rel="stylesheet" href="../assets/css/admin_common.css">

</head>

<body class="admin-recipes">
    <?php include('./admin_sidebar.php'); ?>


    <!-- Main -->
    <div class="main">
        <header class="topbar">
            <div class="topbar-right">
                <div class="welcome">Welcome, <strong><?= htmlspecialchars($userRow['first_name'] . ' ' . $userRow['last_name']) ?></strong></div>
            </div>
        </header>

        <section class="content">
            <div class="page-header">
                <h1>Recipes</h1>
                <div class="actions">
                    <form method="GET" class="search-form" action="recipes.php">
                        <input type="search" name="q" placeholder="Search recipes..." value="<?= htmlspecialchars($search) ?>">
                        <button type="submit">Search</button>
                    </form>
                    <a href="recipe_create.php" class="btn btn-primary">+ Create Recipe</a>
                </div>
            </div>

            <div class="meta-row">
                <div class="meta-item">Total recipes: <span class="meta-count"><?= $totalRecipes ?></span></div>
                <?php if ($hasSearch): ?>
                    <div class="meta-item">Showing results for: <em><?= htmlspecialchars($search) ?></em></div>
                <?php endif; ?>
            </div>

            <div class="table-wrap">
                <table class="recipes-table" aria-describedby="recipes-list">
                    <thead>
                        <tr>
                            <th class="col-thumb">Thumb</th>
                            <th>Title</th>
                            <th>Cuisine</th>
                            <th>Dietary</th>
                            <th>Difficulty</th>
                            <th>Featured</th>
                            <th>Author</th>
                            <th>Created</th>
                            <th class="col-actions">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($result && $result->num_rows > 0): ?>
                            <?php while ($r = $result->fetch_assoc()): ?>
                                <tr>
                                    <td class="col-thumb">
                                        <?php
                                        $imgUrl = resolve_image_url_from_admin($r['cover_img_src'] ?? '');
                                        if ($imgUrl !== ''):
                                        ?>
                                            <img src="<?= htmlspecialchars($imgUrl) ?>" alt="<?= htmlspecialchars($r['title']) ?>">
                                        <?php else: ?>
                                            <div class="no-thumb">No image</div>
                                        <?php endif; ?>
                                    </td>
                                    <td class="title-cell"><?= htmlspecialchars($r['title']) ?></td>
                                    <td><?= htmlspecialchars($r['cuisine_type'] ?? '') ?></td>
                                    <td><?= htmlspecialchars($r['dietary_preference'] ?? '') ?></td>
                                    <td><?= htmlspecialchars($r['difficulty'] ?? '') ?></td>
                                    <td>
                                        <?php if ($r['is_featured']): ?>
                                            <span class="chip">Featured</span>
                                        <?php else: ?>
                                            —
                                        <?php endif; ?>
                                    </td>
                                    <td><?= htmlspecialchars(trim(($r['first_name'] ?? '') . ' ' . ($r['last_name'] ?? ''))) ?></td>
                                    <td><?= htmlspecialchars(date('M d, Y', strtotime($r['created_at']))) ?></td>
                                    <td class="col-actions">
                                        <!-- UI-only links for now -->
                                        <a class="btn small outline" href="recipe_edit.php?id=<?= (int)$r['recipe_id'] ?>">Edit</a>
                                        <a class="btn small danger" href="recipe_delete.php?id=<?= (int)$r['recipe_id'] ?>"
                                            onclick="return confirm('Are you sure you want to delete this recipe?');">Delete</a>
                                    </td>

                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="9">
                                    <div class="empty">No recipes yet — click <a href="recipe_create.php">Create Recipe</a> to add one.</div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

        </section>
        <?php include('./admin_footer.php'); ?>
</body>

</html>