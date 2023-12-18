<?php
session_start();
require_once('db.php');

if (!isset($_SESSION['user_id'])) {
  header('Location: login.php');
  exit();
}

$user_id = $_SESSION['user_id'];

// Check if form submitted
if (isset($_POST['submit'])) {
  $title = $_POST['title'];
  $description = $_POST['description'];
  $deadline = $_POST['deadline'];
  $assigned_to = $_POST['assigned_to'];
  $task_id = $_POST['task_id'];

  // Update task in database
  $sql = "UPDATE tasks SET title='$title', description='$description', deadline='$deadline', assigned_to='$assigned_to' WHERE id=$task_id AND user_id=$user_id";
  if ($conn->query($sql) === TRUE) {
    header('Location: Tasks.php');
    exit();
  } else {
    echo "Error updating task: " . $conn->error;
  }
}

// Get task information
if (isset($_GET['id'])) {
  $task_id = $_GET['id'];
  $sql = "SELECT * FROM tasks WHERE id=$task_id AND user_id=$user_id";
  $result = $conn->query($sql);
  if ($result->num_rows == 1) {
    $task = $result->fetch_assoc();
  } else {
    header('Location: Tasks.php');
    exit();
  }
} else {
  header('Location: Tasks.php');
  exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit Task</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
  <style>
    body {
      font-family: 'Montserrat', sans-serif;
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
            <a class="nav-link" href="Tasks.php">Tasks</a>
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
        <h1>Edit Task</h1>
      </div>
      <div class="col-md-4 text-right">
        <a href="Tasks.php" class="btn btn-secondary">Cancel</a>
      </div>
    </div>

    <hr>

    <form method="POST" action="">
      <input type="hidden" name="task_id" value="<?php echo $task['id']; ?>">
      <div class="form-group">
        <label>Title:</label>
        <input type="text" name="title" class="form-control" value="<?php echo $task['title']; ?>">
      </div>
      <div class="form-group">
        <label>Description:</label>
        <textarea name="description" class="form-control"><?php echo $task['description']; ?></textarea>
      </div>
      <div class="form-group">
            <label>Deadline:</label>
            <input type="date" name="deadline" class="form-control" value="<?php echo $task['deadline']; ?>">
            </div>
        <div class="form-group">
            <label>Assigned To:</label>
            <input type="text" name="assigned_to" class="form-control" value="<?php echo $task['assigned_to']; ?>">
        </div>
        <div class="form-group">
            <button type="submit" name="submit" class="btn btn-primary">Save Changes</button>
        </div>
    </form>

    </div>
     <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
     <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    </body>
</html>
<?php
$conn->close();
?>
