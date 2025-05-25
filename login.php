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

        if($storedPassword == " "){
            echo '<script>
                alert("New User");
            </script>';
            header("Location: ./register.php");
        }
       

        // Password check - supports hashed or plain for now
        if (password_verify($password, $storedPassword) || $password == $storedPassword) {
            $_SESSION['userID'] = $row['userEmail'];
            $_SESSION['category'] = $row['category'];

            if ($_SESSION['category'] === 'admin') {
                header("Location: ./admin/admin_sidebar.php");
            } else {
                header("Location: ./user/user_dashboard.php"); // Adjust as needed
            }
            exit();
        } else {
            echo '<script>
                alert("Incorrect password.");
                //window.history.back();
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
    </div>
</body>
</html>
