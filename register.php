<?php 

include('./config/database.php');

$message = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $userEmail = $_POST['email'];
    $ic = $_POST['ic'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmpassword'];


    $query = $conn->prepare('SELECT * FROM staff WHERE staffEmail = ? ');
    $query->bind_param('s', $userEmail);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $StaffIC = $row['staffIC'];

        // check sama ke tak ic yang diletak dengan ic kat database
        if ($ic == $StaffIC) {

            if($password == $confirmPassword){
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                
                $update = $conn->prepare("UPDATE user SET userPassword = ? WHERE userEmail = ?");
                $update->bind_param("ss", $hashedPassword, $userEmail);
                
                 
                if ($update->execute()) {
                    $message = "Account Created Successfully";
                } else {
                    echo "<script>alert('Failed to update password');</script>";
                }
                  
            }
        } else {
            echo '<script>
                alert("IC Not Found.");
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
    <title>Register Page</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
            <?php if (!empty($message)): ?>
            <p class="message" style="color: green;"><?php echo htmlspecialchars($message); ?></p>
        <?php endif; ?>

        <div class="container">
        <h2>Account Verification</h2>
        <form action="" method="post">
            <div>
                <input type="email" placeholder="Email" name="email" required>
            </div>
             <div>
                <input type="text" placeholder=" IC Number" name="ic" required>
            </div>
            
            <div>
                <input type="password" placeholder="New Password" name="password" >
            </div>
            <div>
                <input type="password" placeholder=" Confirm Password" name="confirmpassword" >
            </div>
            <div>
                <button type="submit">Verify Account</button>
            </div>
            <a>Existing Staff? Login <a href="login.php">Here.</a></a>
           
        </form>


    </div>
</body>
</html>
