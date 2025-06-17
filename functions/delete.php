<?php
include('../config/database.php');

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

$type = $_POST['type']; // e.g., 'request', 'staff', 'performance'

switch ($type) {
    case 'request':
        $requestID = $_POST['requestID'];
        $query = "DELETE FROM request_updates WHERE requestID=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $requestID);
        $result = $stmt->execute();
        break;

    case 'staff':
        $staffID = $_POST['staffID'];
        $query = "DELETE FROM staff WHERE staffID=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $staffID);
        $result = $stmt->execute();
        break;

    case 'performance':
        $performID = $_POST['performID'];
        $query = "DELETE FROM performance WHERE performID=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $performID);
        $result = $stmt->execute();
        break;

    default:
        swalAndGoBack("error", "Invalid", "Invalid delete type.");
}

if ($result) {
    swalAndGoBack("success", "Deleted", "Record deleted successfully.");
} else {
    swalAndGoBack("error", "Error", "Error deleting record: " . $stmt->error);
}
?>
