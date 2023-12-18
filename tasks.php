<?php
session_start();
require_once('db.php');

if (!isset($_SESSION['user_id'])) {
  header('Location: login.php');
  exit();
}

$user_id = $_SESSION['user_id'];

// Get user's tasks
$sql = "SELECT * FROM tasks WHERE user_id = $user_id ORDER BY id DESC";
$result = $conn->query($sql);
$tasks = [];
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $tasks[] = $row;
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Task Management</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
  <style>
    body {
      font-family: 'Montserrat', sans-serif;
    }
    .truncate {
      overflow: hidden;
      text-overflow: ellipsis;
      white-space: nowrap;
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
          <li class="nav-item active">
            <a class="nav-link" href="tasks.php">Tasks</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="login.php">Logout</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container mt-4">
    <div class="row">
      <div class="col-md-8">
        <h1>My Tasks</h1>
      </div>
      <div class="col-md-4 text-right">
        <a href="add_task.php" class="btn btn-primary">Add Task</a>
      </div>
    </div>

    <hr>

    <?php if (count($tasks) > 0): ?>
  <ul class="list-group">
  <?php foreach ($tasks as $task): ?>
  <li class="list-group-item">
    <div class="row">
      <div class="col-md-8">
        <h5 class="truncate"><?php echo $task['title']; ?></h5>
        <p class="truncate"><?php echo $task['description']; ?></p>
        <p><?php echo $task['deadline']; ?></p>
        <p><?php echo $task['assigned_to']; ?></p>
      </div>
      <div class="col-md-4 text-right">
        <?php
        $deadline = strtotime($task['deadline']);
        $currentDate = strtotime(date('Y-m-d'));
        if ($currentDate > $deadline) {
          $status = 'Late';
          $statusClass = 'text-danger';
        } else {
          $status = 'In Progress';
          $statusClass = 'text-success';
        }
        ?>
        <p class="<?php echo $statusClass; ?>"><?php echo $status; ?></p>
        <a href="view_task.php?id=<?php echo $task['id']; ?>" class="btn btn-sm btn-info">View</a>
        <a href="edit_task.php?id=<?php echo $task['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
        <a href="delete_task.php?id=<?php echo $task['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this task?')">Delete</a>
      </div>
    </div>
  </li>
<?php endforeach; ?>

  </ul>
<?php else: ?>
  <p>No tasks found.</p>
<?php endif; ?>

</div>

</body>
</html>
