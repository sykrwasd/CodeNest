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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
     <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    
</head>
<body id="login">
    <div class="container"
        <h2>Login</h2>
        <form action="" method="post">
            <div>
                <input type="email" placeholder="Email" name="userid" required>
            </div>
            <div>
                <input type="password" placeholder="Password" name="password" >
            </div>
            <div>
                <button type="submit">Login</button>
            </div>
            <a>New Staff? Verify <a href="register.php">Here.</a></a> <br>
             <a href="login.php">Forgot Password?</a>
        </form>

        </div><br>
            
             <button type="submit" data-bs-toggle="modal" data-bs-target="#myModal">View Staff</button>

                <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">

                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Staff List</h5>
                        </div>

                        <div class="modal-body" id="modalBody">
                            <table class="table table-bordered table-hover staff-table">
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
                                    <td><?php echo $row['staffFullName']; ?></td>
                                    <td><?php echo $row['staffEmail']; ?></td>
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
                    </div>

                        

</body>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
</html>
