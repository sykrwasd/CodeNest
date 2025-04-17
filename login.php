<?php 
session_start();
include('config/database.php');

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = $conn->prepare('SELECT * FROM user WHERE username = ?');
    $query->bind_param('s', $username);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        $storedPassword = $user['password'];

        
        if (password_verify($password, $storedPassword) || $password === $storedPassword) {
            // Login successful
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header("Location: dashboard.php");
            exit();
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "User not found.";
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
<body>
    <div class="container">
        <h2>Login</h2>
        <form action="#" method="post">
            <div>
                <input type="text" placeholder="Username" required>
            </div>
            <div>
                <input type="password" placeholder="Password" required>
            </div>
            <div>
                <button type="submit">Login</button>
            </div>
            <a>New Staff? Verify <a href="register.php">Here.</a></a>
        </form>
    </div>
</body>
</html>
