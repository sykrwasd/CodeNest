<?php
include('../config/database.php');

$type = $_POST['type'];

switch ($type) {
    case 'request':
        $requestID = $_POST['requestID'];
        $query = "UPDATE request_updates SET status='Read' WHERE requestID=$requestID";
        break;

    case 'staff':
        echo '<script>alert("this is from view_staff"); window.history.back();</script>';
        exit;

    case 'performance':
        $performID = $_POST['performID'];
        $query = "UPDATE performance SET status='Read' WHERE performID=$performID";
        $result = mysqli_query($conn, $query);
        break;

    case 'payroll':
        foreach ($_POST['payrollID'] as $id) {
            $bonus = $_POST['bonus'][$id];
            $deduction = $_POST['deduction'][$id];

            $query = "UPDATE payroll SET bonus='$bonus', deduction='$deduction' WHERE payrollID=$id";
            mysqli_query($conn, $query);
        }

        echo '<script>alert("Payroll updated successfully."); window.history.back();</script>';
        exit;

    default:
        die("Invalid update type.");
}

if (isset($query) && $type != 'payroll') {
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo '<script>alert("Updated successfully."); window.history.back();</script>';
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
