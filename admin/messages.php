<?php
// admin/messages.php
include '../includes/db_connect.php';
session_start();

// --- Auth: require admin ---
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

// --- Fetch messages ---
$sql = "SELECT message_id, name, email, subject, message, submitted_at FROM contact_messages ORDER BY submitted_at DESC";
$result = $conn->query($sql);
$totalMessages = $result ? $result->num_rows : 0;
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>Admin — Contact Messages | FoodFusion</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="../assets/css/admin_common.css">
  <link rel="stylesheet" href="../assets/css/admin_messages.css">
</head>
<body class="admin-page">

  <?php include './admin_sidebar.php'; ?>

  <div class="admin-main">
    <header class="admin-topbar">
      <div class="topbar-right">
        <div class="admin-welcome">
          Welcome, <strong><?= htmlspecialchars($userRow['first_name'] . ' ' . $userRow['last_name']) ?></strong>
        </div>
      </div>
    </header>

    <main class="admin-content">
      <h1 class="admin-heading">Contact Messages</h1>
      <p class="meta">Total messages: <?= $totalMessages ?></p>

      <div class="table-wrap">
        <table class="table messages-table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Email</th>
              <th>Subject</th>
              <th>Message</th>
              <th>Submitted</th>
              <th class="col-actions">Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php if ($result && $result->num_rows > 0): ?>
              <?php while ($m = $result->fetch_assoc()): ?>
                <tr>
                  <td><?= (int)$m['message_id'] ?></td>
                  <td><?= htmlspecialchars($m['name']) ?></td>
                  <td><?= htmlspecialchars($m['email']) ?></td>
                  <td><?= htmlspecialchars($m['subject']) ?></td>
                  <td><?= htmlspecialchars(substr($m['message'], 0, 40)) ?>...</td>
                  <td><?= date('M d, Y', strtotime($m['submitted_at'])) ?></td>
                  <td class="col-actions">
                    <a href="message_view.php?id=<?= (int)$m['message_id'] ?>" class="btn small">View</a>
                    <a href="message_delete.php?id=<?= (int)$m['message_id'] ?>" class="btn small outline">Delete</a>
                  </td>
                </tr>
              <?php endwhile; ?>
            <?php else: ?>
              <tr>
                <td colspan="7" class="empty">No messages found.</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </main>

    <?php include './admin_footer.php'; ?>
  </div>
</body>
</html>
