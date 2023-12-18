<?php
session_start();

// check if user is not logged in
if (!isset($_SESSION['user_id'])) {
  header('Location: login.php');
  exit();
}

require_once 'db.php';

$errors = array();

// if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $title = $_POST['title'];
  $description = $_POST['description'];
  $user_id = $_SESSION['user_id'];
  $deadline = $_POST['deadline'];
    $assigned_to = $_POST['assigned_to'];


  // validate form data
  if (empty($title)) {
    $errors[] = 'Title is required.';
  }

  if (empty($description)) {
    $errors[] = 'Description is required.';
  }

  // if no errors, insert task into database
  if (count($errors) == 0) {
    $sql = "INSERT INTO tasks (title, description, user_id, deadline, assigned_to) 
        VALUES ('$title', '$description', $user_id, '$deadline', '$assigned_to')";


    if ($conn->query($sql) === TRUE) {
      header('Location: tasks.php');
      exit();
    } else {
      echo 'Error: ' . $sql . '<br>' . $conn->error;
    }
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Task</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
  <style>
    body {
      font-family: 'Montserrat', sans-serif;
    }
  </style>
</head>
<body>

<div class="container">

  <h1>Add Task</h1>

  <?php if (count($errors) > 0): ?>
    <div class="alert alert-danger">
      <?php foreach ($errors as $error): ?>
        <p><?php echo $error; ?></p>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>

  <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <div class="form-group">
      <label for="title">Title</label>
      <input type="text" class="form-control" id="title" name="title" value="<?php echo isset($_POST['title']) ? $_POST['title'] : ''; ?>">
    </div>
    <div class="form-group">
      <label for="description">Description</label>
      <textarea class="form-control" id="description" name="description"><?php echo isset($_POST['description']) ? $_POST['description'] : ''; ?></textarea>
    </div>
    <div class="form-group">
            <label>Deadline</label>
            <input type="date" name="deadline" class="form-control">
        </div>
        <div class="form-group">
            <label>Assigned To</label>
            <input type="text" name="assigned_to" class="form-control">
        </div>

    <button type="submit" class="btn btn-primary">Add Task</button>
  </form>

</div>

</body>
</html>
