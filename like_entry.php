<?php
include './includes/db_connect.php';
if (!isset($_SESSION)) {
    session_start();
}
if (isset($_POST['entry_id'])) {
    $entry_id = (int)$_POST['entry_id'];
    $conn->query("UPDATE community_cookbook SET likes = likes + 1 WHERE entry_id = $entry_id");
    $result = $conn->query("SELECT likes FROM community_cookbook WHERE entry_id = $entry_id");
    $row = $result->fetch_assoc();
    echo $row['likes'];
}
