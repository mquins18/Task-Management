<?php
session_start();
require_once('db.php');

if (!isset($_SESSION['user_id'])) {
  header('Location: login.php');
  exit();
}

$user_id = $_SESSION['user_id'];

// Get the task ID from the URL parameter
$task_id = $_GET['id'];

// Get the task details
$sql = "SELECT * FROM tasks WHERE id = $task_id AND user_id = $user_id";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  $task = $result->fetch_assoc();

  // Calculate the status of the task
  $deadline = strtotime($task['deadline']);
  $currentDate = strtotime(date('Y-m-d'));
  if ($currentDate > $deadline) {
    $status = 'Late';
  } else {
    $status = 'In Progress';
  }
} else {
  // If the task doesn't exist or doesn't belong to the user, redirect to the task list page
  header('Location: tasks.php');
  exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>View Task</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
  <style>
    body {
      font-family: 'Montserrat', sans-serif;
    }
    .truncate {
    overflow-wrap: break-word;
    word-wrap: break-word;
  }
 
  </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
      <a class="navbar-brand" href="tasks.php">Task Management</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" href="aboutus.html">About Us</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="tasks.php">Tasks</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="login.php">Logout</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container mt-4" style="padding: 20px;">
    <div class="row">
      <div class="col-md-8">
       <h1 class="truncate"><?php echo $task['title']; ?></h1>
      </div>
      <div class="col-md-4 text-right">
        <a href="edit_task.php?id=<?php echo $task['id']; ?>" class="btn btn-warning"><i class="fas fa-edit"></i> Edit</a>
        <a href="delete_task.php?id=<?php echo $task['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this task?')"><i class="fas fa-trash-alt"></i> Delete</a>
    </div>
    </div>

    <hr>
    <p>Status: <span><?php echo $status; ?></span></p>
    <p>Assigned To: <span></span><?php echo $task['assigned_to']; ?></p>
    <p>Deadline:    <span></span><?php echo $task['deadline']; ?></p>
    <p class="truncate">Description: <span></span><?php echo $task['description']; ?></p>

  </div>

</body>
</html>


