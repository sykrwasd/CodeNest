<?php
include('../config/database.php');


$type = $_POST['type']; // e.g., 'request', 'staff', 'payroll'


    switch ($type) {
        case 'request':
            $requestID = $_POST['requestID'];
            $query = "UPDATE request_updates SET status='Read' WHERE requestID=$requestID";
            break;
        case 'staff':
            echo '<script>alert("this is from view_staff"); window.history.back();</script>';
            break;
        case 'performance':
            $performID = $_POST['performID'];
            $query = "UPDATE performance SET status='Read' WHERE performID=$performID";
            break;    
        default:
            die("Invalid update type.");
    }

$result = mysqli_query($conn, $query);

if ($result) {
    echo '<script>alert("Updated"); window.history.back();</script>';
} else {
    echo "Error: " . mysqli_error($conn);
}
?>
