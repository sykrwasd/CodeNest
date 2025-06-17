<?php 
session_start();
include('./config/database.php');

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $userEmail = $_POST['userid'];
    $password = $_POST['password'];

    $query = $conn->prepare('SELECT * FROM user WHERE userEmail = ?');
    $query->bind_param('s', $userEmail);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $storedPassword = $row['userPassword'];

        if ($storedPassword === "newuser") {
            echo '<script>
                alert("New user detected");
                window.location.href = "./register.php";
            </script>';
            exit(); 
        }

        if (password_verify($password, $storedPassword) || $password == $storedPassword) {
            $_SESSION['userEmail'] = $row['userEmail'];
            $_SESSION['userID'] = $row['userID'];   
            $_SESSION['category'] = $row['category'];

            if ($_SESSION['category'] == 'admin') {
                $query = $conn->prepare('SELECT * FROM admin WHERE adminEmail = ?');
                $query->bind_param('s', $userEmail);
                $query->execute();
                $result = $query->get_result();
                $_SESSION['adminID'] = $result->fetch_assoc()['adminID'];
                header("Location: ./admin/admin_sidebar.php");
            } else {
                $query = $conn->prepare('SELECT * FROM staff WHERE staffEmail = ?');
                $query->bind_param('s', $userEmail);
                $query->execute();
                $result = $query->get_result();
                $_SESSION['staffID'] = $result->fetch_assoc()['staffID'];
                header("Location: ./user/user_sidebar.php");
            }
            exit();
        } else {
            echo '<script>
                alert("Incorrect password.");
                window.history.back();
            </script>';
        }
    } else {
        echo "<script>alert('User Not Found');window.history.back();</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Login Page</title>
  <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
    crossorigin="anonymous">
  <link rel="stylesheet" href="css/style.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body id="login">

  <div class="card shadow-lg border-0 rounded-4 bg-light mx-auto mt-5" style="width: 100%; max-width: 450px;">
    <div class="card-header bg-primary text-white text-center">
      <h3>Login</h3>
    </div>
    <div class="card-body">
      <form action="" method="post">
        <div class="mb-3">
          <input type="email" class="form-control" name="userid" placeholder="Company Email" required>
        </div>
        <div class="mb-3">
          <input type="password" class="form-control" name="password" placeholder="Password" required>
        </div>
        <div class="d-grid">
          <button type="submit" class="btn btn-primary">Login</button>
        </div>
        <div class="mt-3 text-center">
          <p class="mb-1">New Staff? <a href="register.php">Verify Here</a></p>
          
        </div>
      </form>
    </div>
    <div class="card-footer text-muted text-center">
      Having issues? Contact <strong>HR Support</strong> at <a href="mailto:hr@naza.com.my">hr@naza.com.my</a> or call +603-2386 8000.
    </div>
  </div>
</div>

<!-- View Staff Modal Trigger -->
<div class="text-center mt-4">
  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">View Staff</button>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Staff List</h5>
      </div>
      <div class="modal-body">
        <table class="table table-bordered table-hover">
          <thead class="table-primary text-center">
            <tr>
              <th scope="col">Full Name</th>
              <th scope="col">Company Email</th>
            </tr>
          </thead>
          <tbody>
            <?php 
              $viewQuery = $conn->prepare('SELECT * FROM staff');
              $viewQuery->execute();
              $result = $viewQuery->get_result();
              while ($row = $result->fetch_assoc()) {
            ?>
              <tr class="text-center">
                <td><?= $row['staffFullName']; ?></td>
                <td><?= $row['staffEmail']; ?></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
  crossorigin="anonymous"></script>
</body>
</html>
