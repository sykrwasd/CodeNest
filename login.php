<?php 
session_start();
include('config/database.php');
$error = "";
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = $conn->prepare('SELECT * FROM user WHERE username = ?');
    $query->bind_param('s', $username);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $storedPassword = $row['password'];

        
        if (password_verify($password, $storedPassword) || $password === $storedPassword) {
            // Login successful
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['level'] = $row['level'];
           
            if($_SESSION['level'] == 'admin'){
                header("Location: admin/admin_sidebar.php");
                exit();
            }
        } else {
            $error = "Invalid password.";
        }
    } else {
        $error = "User not found.";
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
    <div class="container">
        <div class="error-message">
            <?php echo $error?>
        </div>
        <h2>Login</h2>
        <form action="login.php" method="post">
            <div>
                <input type="text" placeholder="Username" name="username" required>
            </div>
            <div>
                <input type="password" placeholder="Password" name="password" required>
            </div>
            <div>
                <button type="submit">Login</button>
            </div>
            <a>New Staff? Verify <a href="register.php">Here.</a></a>
        </form>
    </div>
</body>
</html>
