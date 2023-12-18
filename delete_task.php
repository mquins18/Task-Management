<?php
session_start();
require_once('db.php');

if (!isset($_SESSION['user_id'])) {
  header('Location: login.php');
  exit();
}

$user_id = $_SESSION['user_id'];

if (isset($_GET['id'])) {
  $task_id = $_GET['id'];
  $sql = "DELETE FROM tasks WHERE id = $task_id AND user_id = $user_id";
  $result = $conn->query($sql);
  if ($result) {
    header('Location: tasks.php');
    exit();
  } else {
    echo "Error deleting task";
  }
} else {
  echo "Invalid task ID";
}
?>
