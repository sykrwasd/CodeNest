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

// Get total request
$sql = "SELECT COUNT(*) AS total_request FROM request_updates";
$result = $conn->query($sql);
if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $data['total_request'] = $row['total_request'];
}

// Get total evaluation
$sql = "SELECT COUNT(*) AS total_eval FROM performance";
$result = $conn->query($sql);
if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $data['total_eval'] = $row['total_eval'];
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


// Fetch 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $staffID = $_POST['staffID'];
    $date = $_POST['payDate']; // 2025-06
    $page = $_POST['page'];

    if ($page == "staff") {
        $query = $conn->prepare("
            SELECT staff.*, payroll.*
            FROM staff 
            INNER JOIN payroll ON staff.staffID = payroll.staffID
            WHERE staff.staffID = ? AND DATE_FORMAT(payroll.payDate, '%Y-%m') = ?");
        $query->bind_param("ss", $staffID, $date);
        $query->execute();
        $result = $query->get_result();

        if ($row = $result->fetch_assoc()) {
            header('Content-Type: application/json');
            echo json_encode($row);
        } else {
            echo json_encode(['error' => 'No data found']);
        }
        exit;
    } else {
        $query = $conn->prepare("
            SELECT p.*, s.staffFullName 
            FROM payroll p 
            INNER JOIN staff s ON p.staffID = s.staffID
            WHERE DATE_FORMAT(p.payDate, '%Y-%m') = ?");
        $query->bind_param("s", $date);
        $query->execute();
        $result = $query->get_result();

        $rows = [];

        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }

        header('Content-Type: application/json');
        echo json_encode($rows); // return full array
        exit;
    }
}


// Set header and return JSON
header('Content-Type: application/json');
echo json_encode($data);
?>