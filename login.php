<?php
session_start();
require_once('db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $email = $_POST['email'];
  $password = $_POST['password'];

  $sql = "SELECT * FROM users WHERE email = '$email'";
  $result = $conn->query($sql);
  if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['password'])) {
      $_SESSION['user_id'] = $row['id'];
      header('Location: tasks.php');
      exit();
    } else {
      $error_msg = "Invalid email or password!";
    }
  } else {
    $error_msg = "Invalid email or password!";
  }
}

$conn->close();

function togglePasswordVisibility() {
  echo '
    <script>
      function togglePasswordVisibility() {
        const passwordField = document.getElementById("password");
        const icon = document.getElementById("togglePasswordVisibilityIcon");

        if (passwordField.type === "password") {
          passwordField.type = "text";
          icon.classList.remove("fa-eye");
          icon.classList.add("fa-eye-slash");
        } else {
          passwordField.type = "password";
          icon.classList.remove("fa-eye-slash");
          icon.classList.add("fa-eye");
        }
      }
    </script>
  ';
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
  <style>
    body {
      font-family: 'Montserrat', sans-serif;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="row justify-content-center mt-5">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h1 class="text-center">Login</h1>
          </div>
          <div class="card-body">
            <?php if (isset($error_msg)) { echo "<div class='alert alert-danger'>$error_msg</div>"; } ?>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
              <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
              </div>
              <div class="form-group">
                <label for="password">Password:</label>
                <div class="input-group">
                  <input type="password" class="form-control" id="password" name="password" required>
                  <div class="input-group-append">
                    <span class="input-group-text" onclick="togglePasswordVisibility()">
                      <i id="togglePasswordVisibilityIcon" class="fa fa-eye"></i>
                    </span>
                  </div>
                </div>
              </div>
              <p>Not have an account?<a href="signup.php">Sign Up Here</a></p>
              <button type="submit" class="btn btn-primary"><i class="fa fa-sign-in-alt"></i> Login</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php togglePasswordVisibility(); ?>

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></
