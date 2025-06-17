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
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body id="login">
    <?php if (!empty($message)): ?>
        <div class="alert alert-success text-center" role="alert">
            <?php echo htmlspecialchars($message); ?>
        </div>
    <?php endif; ?>

    <div class="card shadow-lg border-0 rounded-4 bg-light mx-auto mt-5" style="width: 100%; max-width: 450px;">
        <div class="card-header bg-primary text-white text-center">
            <h3>Account Verification</h3>
        </div>
        <div class="card-body">
            <form action="" method="post">
                <div class="mb-3">
                    <input type="email" class="form-control" name="email" placeholder="Company Email" required>
                </div>
                <div class="mb-3">
                    <input type="text" class="form-control" name="ic" placeholder="IC Number" required>
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control" name="password" placeholder="New Password" required>
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control" name="confirmpassword" placeholder="Confirm Password" required>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Verify Account</button>
                </div>
                <div class="mt-3 text-center">
                    <p class="mb-1">Existing Staff? <a href="login.php">Login Here</a></p>
                </div>
            </form>
        </div>
        <div class="card-footer text-muted text-center">
            Having issues? Contact <strong>HR Support</strong> at <a href="mailto:hr@naza.com.my">hr@naza.com.my</a> or call +603-2386 8000.
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
</body>
</html>
