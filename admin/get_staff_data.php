<?php
include('../config/database.php');

if(isset($_GET['staffID'])) {
    $staffID = $_GET['staffID'];
    
    $query = $conn->prepare('SELECT * FROM staff WHERE staffID = ?');
    $query->bind_param('i', $staffID);
    $query->execute();
    $result = $query->get_result();
    
    if($row = $result->fetch_assoc()) {
        echo json_encode($row);
    } else {
        echo json_encode(['error' => 'Staff not found']);
    }
} else {
    echo json_encode(['error' => 'No staff ID provided']);
}
?> 