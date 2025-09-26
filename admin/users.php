<?php
include '../includes/db_connect.php';
session_start();
// (same admin check as index.php, factor into function later)

$result = $conn->query("SELECT user_id, first_name, last_name, email, created_at, is_admin FROM users ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin - Users</title>
  <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>
  <h2>User List</h2>
  <table class="admin-table">
    <tr>
      <th>ID</th><th>Name</th><th>Email</th><th>Admin</th><th>Joined</th>
    </tr>
    <?php while($row = $result->fetch_assoc()): ?>
      <tr>
        <td><?= $row['user_id'] ?></td>
        <td><?= htmlspecialchars($row['first_name'].' '.$row['last_name']) ?></td>
        <td><?= htmlspecialchars($row['email']) ?></td>
        <td><?= $row['is_admin'] ? '✅' : '❌' ?></td>
        <td><?= $row['created_at'] ?></td>
      </tr>
    <?php endwhile; ?>
  </table>
</body>
</html>
