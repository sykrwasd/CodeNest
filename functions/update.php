<?php
include('../config/database.php');

$type = $_POST['type'];

function swalAndRedirect($icon, $title, $text, $redirect) {
    echo "
    <html>
    <head>
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
         <link rel='stylesheet' href='../css/view_staff.css'>
    </head>
    <body>
        <script>
            Swal.fire({
                icon: '$icon',
                title: '$title',
                text: '$text',
                confirmButtonText: 'OK'
            }).then(() => {
                window.location.href = '$redirect';
            });
        </script>
    </body>
    </html>";
    exit;
}

function swalAndGoBack($icon, $title, $text) {
    echo "
    <html>
    <head>
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
         <link rel='stylesheet' href='../css/view_staff.css'>
    </head>
    <body>
        <script>
            Swal.fire({
                icon: '$icon',
                title: '$title',
                text: '$text',
                confirmButtonText: 'Back'
            }).then(() => {
                window.history.back();
            });
        </script>
    </body>
    </html>";
    exit;
}

switch ($type) {
    case 'request':
        $requestID = $_POST['requestID'];
        $query = "UPDATE request_updates SET status='Read' WHERE requestID=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $requestID);
        $result = $stmt->execute();

        if ($result) {
            swalAndGoBack("success", "Updated", "Request marked as read.");
        } else {
            swalAndGoBack("error", "Error", "Failed to update request.");
        }
        break;

    case 'staff':
        $fullName = $_POST['fname'];
        $dob = $_POST['dob'];
        $phone = $_POST['pnum'];
        $email = $_POST['email'];
        $department = $_POST['department'];
        $staffIC = $_POST['staffIC'];
        $address = $_POST['address1'];
        $id = $_POST['id'];

        $query = "UPDATE staff 
                SET staffFullName = ?, 
                    staffDOB = ?, 
                    staffNoPhone = ?, 
                    staffAddress = ?
                WHERE staffIC = ?";

        $stmt = $conn->prepare($query);
        if (!$stmt) {
            die("Prepare failed for staff update: " . $conn->error);
        }

        $stmt->bind_param("sssss", $fullName, $dob, $phone, $address, $staffIC);
        $result = $stmt->execute();

        $querySelect = "SELECT d.departmentID 
                        FROM staff s
                        JOIN staff_department sd ON s.staffID = sd.staffID
                        JOIN department d ON sd.departmentID = d.departmentID
                        WHERE s.staffID = ?";
        $stmtSelect = $conn->prepare($querySelect);
        $stmtSelect->bind_param("i", $id);
        $stmtSelect->execute();
        $resultSelect = $stmtSelect->get_result();

        if ($row = $resultSelect->fetch_assoc()) {
        $departmentID = $row['departmentID'];

        // 2. UPDATE departmentType berdasarkan departmentID
        $queryUpdate = "UPDATE department SET departmentType = ? WHERE departmentID = ?";
        $stmtUpdate = $conn->prepare($queryUpdate);
        $stmtUpdate->bind_param("si", $department, $departmentID);
        $stmtUpdate->execute();

        if ($result && $stmtUpdate) {
        swalAndRedirect("success", "Success", "Staff updated successfully.", "../admin/admin_sidebar.php?page=view_staff");
        } else {
        // Kita buat error message yang selamat
        $errorMsg = "Error updating staff data: ";
        if (!$result) $errorMsg .= $stmt->error;
        if (!$stmtUpdate) $errorMsg .= " | Department Error: " . $stmt1->error;

        swalAndGoBack("error", "Error", $errorMsg);
    }

    $stmt->close();
    $stmtUpdate->close();
    break;
    }

    case 'performance':
        $performID = $_POST['performID'];
        $query = "UPDATE performance SET status='Read' WHERE performID=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $performID);
        $result = $stmt->execute();

        if ($result) {
            swalAndGoBack("success", "Updated", "Performance marked as read.");
        } else {
            swalAndGoBack("error", "Error", "Failed to update performance.");
        }
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

        swalAndGoBack("success", "Updated", "Payroll updated successfully.");
        break;

    default:
        swalAndGoBack("error", "Invalid", "Invalid update type.");
        break;
}
?>
