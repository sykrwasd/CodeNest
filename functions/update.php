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
            swalAndRedirect("success", "Success", "Staff updated successfully.", "../admin/admin_sidebar.php?page=view_staff");
        } else {
            swalAndGoBack("error", "Error", "Error updating staff data: " . $stmt->error);
        }
        $stmt->close();
        break;

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
