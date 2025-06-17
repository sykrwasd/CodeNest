<?php
include '../../config/database.php';

$data = [];

// Total staff
$sql = "SELECT COUNT(*) AS total_staff FROM staff"; // 2
$result = $conn->query($sql);
if ($result && $result->num_rows > 0) {
    $data['total_staff'] = $result->fetch_assoc()['total_staff'];
}

// Total request
$sql = "SELECT COUNT(*) AS total_request FROM request_updates";
$result = $conn->query($sql);
if ($result && $result->num_rows > 0) {
    $data['total_request'] = $result->fetch_assoc()['total_request'];
}

// Total evaluation
$sql = "SELECT COUNT(*) AS total_eval FROM performance";
$result = $conn->query($sql);
if ($result && $result->num_rows > 0) {
    $data['total_eval'] = $result->fetch_assoc()['total_eval'];
}

// Staff by department
$departments = ['Sales', 'Accounting', 'Marketing'];
foreach ($departments as $dept) {
    $sql = "SELECT COUNT(*) AS total FROM staff WHERE staffDepartment = '$dept'";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        $data[strtolower($dept)] = $result->fetch_assoc()['total'];
    }
}

// Request status
$sql = "SELECT 
    SUM(status = 'Read') AS total_read, 
    SUM(status = 'Unread') AS total_unread 
    FROM request_updates";
$result = $conn->query($sql);
if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $data['total_read'] = $row['total_read'];
    $data['total_unread'] = $row['total_unread'];
}

// Monthly payroll summary
$sql = "SELECT 
  DATE_FORMAT(payDate, '%b') AS month, 
  MONTH(payDate) AS month_num,
  SUM(netsalary + bonus - deduction) AS total_payroll,
  SUM(bonus) AS total_bonus,
  SUM(deduction) AS total_deduction
  FROM payroll
  GROUP BY MONTH(payDate)
  ORDER BY MONTH(payDate)";

$result = $conn->query($sql);
$monthlyPayroll = [];
while ($row = $result->fetch_assoc()) {
    $monthlyPayroll[] = $row;
}
$data['monthly_payroll'] = $monthlyPayroll;


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
            WHERE staff.staffID = '$staffID' AND DATE_FORMAT(payroll.payDate, '%Y-%m') = '$date'");
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
            WHERE DATE_FORMAT(p.payDate, '%Y-%m') = '$date'");
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

// Output all data as JSON
header('Content-Type: application/json');
echo json_encode($data);
?>
