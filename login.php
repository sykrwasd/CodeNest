

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
        <form action="functions/login.php" method="post">
            <div>
                <input type="text" placeholder="Email" name="username" required>
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
