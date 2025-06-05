<?php
include('../config/database.php');


$type = $_POST['type']; // e.g., 'request', 'staff', 'payroll'



    switch ($type) {
        case 'request':
            $requestID = $_POST['requestID'];
            $query = "DELETE FROM request_updates WHERE requestID=$requestID";
            break;
        case 'staff':
            echo '<script>alert("this is from view_staff"); window.history.back();</script>';
            break;
         case 'performance':
            $performID = $_POST['performID'];
            $query = "DELETE FROM performance WHERE performID=$performID";
            break;   
        default:
            die("Invalid update type.");
    }

$result = mysqli_query($conn, $query);

if ($result) {
    echo '<script>alert("Deleted"); window.history.back();</script>';
} else {
    echo "Error: " . mysqli_error($conn);
}
?>
