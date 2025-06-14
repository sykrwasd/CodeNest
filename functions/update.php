<?php
include('../config/database.php');

$type = $_POST['type'];

switch ($type) {
    case 'request':
        $requestID = $_POST['requestID'];
        $query = "UPDATE request_updates SET status='Read' WHERE requestID=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $requestID);
        $result = $stmt->execute();
        break;

    case 'staff':
        // Get all submitted values
        $fullName = $_POST['fname'];
        $dob = $_POST['dob'];
        $phone = $_POST['pnum'];
        $email = $_POST['email'];
        $department = $_POST['department'];
        $staffIC = $_POST['staffIC'];
        $address = $_POST['address1'];

        // Prepare the update statement
        $query = "UPDATE staff 
                  SET staffFullName = ?, 
                      staffDOB = ?, 
                      staffNoPhone = ?, 
                      staffDepartment = ?, 
                      staffAddress = ?
                  WHERE staffIC = ?";

        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssssss", $fullName, $dob, $phone, $department, $address, $staffIC);
        $result = $stmt->execute();

        if ($result) {
            echo '<script>alert("Staff updated successfully."); window.location.href = "../admin/admin_sidebar.php?page=view_staff";</script>';
        } else {
            echo '<script>alert("Error updating staff data: ' . $stmt->error . '"); window.history.back();</script>';
        }
        $stmt->close();
        break;

    case 'performance':
        $performID = $_POST['performID'];
        $query = "UPDATE performance SET status='Read' WHERE performID=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $performID);
        $result = $stmt->execute();
        break;

    case 'payroll':
        foreach ($_POST['payrollID'] as $id) {
            $bonus = $_POST['bonus'][$id];
            $deduction = $_POST['deduction'][$id];

            $query = "UPDATE payroll SET bonus=?, deduction=? WHERE payrollID=?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ddi", $bonus, $deduction, $id);
            $stmt->execute();
        }

        echo '<script>alert("Payroll updated successfully."); window.history.back();</script>';
        exit;

    default:
        die("Invalid update type.");
}

if (isset($query) && $type != 'payroll') {
    if ($result) {
        echo '<script>alert("Updated successfully."); window.history.back();</script>';
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
