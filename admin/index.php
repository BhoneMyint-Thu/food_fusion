<?php
// admin/index.php
include '../includes/db_connect.php';
session_start();

// Protect route: must be logged in
if (!isset($_SESSION['user_id'])) {
  header("Location: ../auth/login.php");
  exit;
}
$user_id = (int)$_SESSION['user_id'];

// Check is_admin
$stmt = $conn->prepare("SELECT is_admin, first_name, last_name, email FROM users WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$userRow = $stmt->get_result()->fetch_assoc();
if (!$userRow || (int)$userRow['is_admin'] !== 1) {
  http_response_code(403);
  echo "Access denied. Admins only.";
  exit;
}

// Fetch counts
$totalUsers = (int)$conn->query("SELECT COUNT(*) AS cnt FROM users")->fetch_assoc()['cnt'];
$totalRecipes = (int)$conn->query("SELECT COUNT(*) AS cnt FROM recipes")->fetch_assoc()['cnt'];
$totalMessages = (int)$conn->query("SELECT COUNT(*) AS cnt FROM contact_messages")->fetch_assoc()['cnt'];
$totalEvents = (int)$conn->query("SELECT COUNT(*) AS cnt FROM events")->fetch_assoc()['cnt'];

// Fetch recent data
$recentUsers = [];
$ru = $conn->query("SELECT user_id, first_name, last_name, email, created_at, is_admin FROM users ORDER BY created_at DESC LIMIT 6");
if ($ru) while ($r = $ru->fetch_assoc()) $recentUsers[] = $r;

$recentRecipes = [];
$rr = $conn->query("SELECT recipe_id, title, cuisine_type, difficulty, created_at FROM recipes ORDER BY created_at DESC LIMIT 6");
if ($rr) while ($r = $rr->fetch_assoc()) $recentRecipes[] = $r;

$recentMessages = [];
$rm = $conn->query("SELECT message_id, name, email, subject, submitted_at FROM contact_messages ORDER BY submitted_at DESC LIMIT 6");
if ($rm) while ($r = $rm->fetch_assoc()) $recentMessages[] = $r;

$conn->close();
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>Admin Dashboard — FoodFusion</title>
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <link rel="stylesheet" href="../assets/css/admin_index.css">
  <link rel="stylesheet" href="../assets/css/admin_common.css">

</head>

<body class="admin-page">

  <!-- Sidebar (common include) -->
  <?php include './admin_sidebar.php'; ?>

  <div class="admin-main">
    <header class="admin-topbar">
      <div class="topbar-right">
        <div class="admin-welcome">
          <span class="hello">Welcome,</span>
          <strong><?= htmlspecialchars($userRow['first_name'] . ' ' . $userRow['last_name']) ?></strong>
        </div>
      </div>
    </header>

    <main class="admin-content">
      <h1 class="admin-heading">Dashboard</h1>

      <!-- Stats -->
      <section class="stats-grid">
        <div class="stat card--accent">
          <div class="stat-number"><?= $totalUsers ?></div>
          <div class="stat-label">Users</div>
        </div>
        <div class="stat card--accent">
          <div class="stat-number"><?= $totalRecipes ?></div>
          <div class="stat-label">Recipes</div>
        </div>
        <div class="stat card--accent">
          <div class="stat-number"><?= $totalMessages ?></div>
          <div class="stat-label">Contact Messages</div>
        </div>
        <div class="stat card--accent">
          <div class="stat-number"><?= $totalEvents ?></div>
          <div class="stat-label">Events</div>
        </div>
      </section>

      <!-- Recent Lists -->
      <section class="recent-grid">
        <div class="card">
          <h2>Recent Users</h2>
          <table class="table">
            <thead>
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Admin</th>
                <th>Joined</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($recentUsers as $u): ?>
                <tr>
                  <td><?= (int)$u['user_id'] ?></td>
                  <td><?= htmlspecialchars($u['first_name'] . ' ' . $u['last_name']) ?></td>
                  <td><?= htmlspecialchars($u['email']) ?></td>
                  <td><?= $u['is_admin'] ? 'Yes' : 'No' ?></td>
                  <td><?= htmlspecialchars($u['created_at']) ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
          <a class="btn-link" href="users.php">View all users →</a>
        </div>

        <div class="card">
          <h2>Recent Recipes</h2>
          <table class="table">
            <thead>
              <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Cuisine</th>
                <th>Difficulty</th>
                <th>Created</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($recentRecipes as $r): ?>
                <tr>
                  <td><?= (int)$r['recipe_id'] ?></td>
                  <td><?= htmlspecialchars($r['title']) ?></td>
                  <td><?= htmlspecialchars($r['cuisine_type'] ?? '') ?></td>
                  <td><?= htmlspecialchars($r['difficulty'] ?? '') ?></td>
                  <td><?= htmlspecialchars($r['created_at']) ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
          <a class="btn-link" href="recipes.php">Manage recipes →</a>
        </div>

        <div class="card">
          <h2>Recent Messages</h2>
          <table class="table">
            <thead>
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Subject</th>
                <th>Date</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($recentMessages as $m): ?>
                <tr>
                  <td><?= (int)$m['message_id'] ?></td>
                  <td><?= htmlspecialchars($m['name']) ?></td>
                  <td><?= htmlspecialchars($m['subject']) ?></td>
                  <td><?= htmlspecialchars($m['submitted_at']) ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
          <a class="btn-link" href="messages.php">View all messages →</a>
        </div>
      </section>
    </main>

    <?php include './admin_footer.php'; ?>
  </div>
</body>

</html>