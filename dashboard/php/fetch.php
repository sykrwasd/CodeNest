<?php 

include '../../config/database.php';

$data = [];

// Get total staff
$sql = "SELECT COUNT(*) AS total_staff FROM staff";
$result = $conn->query($sql);
if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $data['total_staff'] = $row['total_staff'];
}

// Get total Factory staff
$sql = "SELECT COUNT(*) AS total_service FROM staff WHERE staffDepartment = 'Service'";
$result = $conn->query($sql);
if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc(); 
    $data['service'] = $row['total_service'];
}

// Get total Accounting staff
$sql = "SELECT COUNT(*) AS total_accounting FROM staff WHERE staffDepartment = 'Accounting'";
$result = $conn->query($sql);
if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $data['accounting'] = $row['total_accounting'];
}

// Get total Marketing staff
$sql = "SELECT COUNT(*) AS total_marketing FROM staff WHERE staffDepartment = 'Marketing'";
$result = $conn->query($sql);
if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $data['marketing'] = $row['total_marketing'];
}

// Get total Read
$sql = "SELECT COUNT(*) AS total_read FROM request_updates WHERE status = 'Read'";
$result = $conn->query($sql);
if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $data['total_read'] = $row['total_read'];
}

// Get total Unread
$sql = "SELECT COUNT(*) AS total_unread FROM request_updates WHERE status = 'Unread'";
$result = $conn->query($sql);
if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $data['total_unread'] = $row['total_unread'];
}

// Set header and return JSON
header('Content-Type: application/json');
echo json_encode($data);
?>
