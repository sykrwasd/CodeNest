<?php 
session_start();
include('../config/database.php');
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
                header("Location: ../admin/admin_sidebar.php");
                exit();
            }
        } else {
           echo '<script>
        alert("User Not Found ");
       
        window.history.back();
      </script>';

          

        }
    } else {
        echo "<script>alert('User Not Found');window.history.back();</script>";
      
        

    }
}
?>