<?php
include('../config/database.php');

$type = $_POST['type'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Inbox View</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" crossorigin="anonymous" />
     <link rel="stylesheet" href="../css/view_staff.css">
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">📬 Inbox Message</h5>
        </div>
        <div class="card-body">

            <?php
            if ($type === 'request' && isset($_POST['requestID'])) {
                $requestID = $_POST['requestID'];
                $stmt = $conn->prepare('SELECT inbox FROM request_updates WHERE requestID = ?');
                $stmt->bind_param("i", $requestID);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($row = $result->fetch_assoc()) {
                    echo '<p class="text-muted">Request ID: <strong>' . $requestID . '</strong></p>';
                    echo '<div class="border rounded p-3 bg-white mb-3">';
                    echo nl2br(htmlspecialchars($row['inbox']));
                    echo '</div>';
                } else {
                    echo '<div class="alert alert-warning">No inbox message found for this request ID.</div>';
                }

                // Back to Request Page
                echo '<a href="?page=view_request" class="btn btn-secondary">
                        <i class="fa fa-arrow-left"></i> Back to Request Inbox
                      </a>';
                
                $stmt->close();
            } elseif ($type === 'performance' && isset($_POST['performID'])) {
                $performanceID = $_POST['performID'];
                $stmt = $conn->prepare('SELECT remarks FROM performance WHERE performID = ?');
                $stmt->bind_param("i", $performanceID);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($row = $result->fetch_assoc()) {
                    echo '<p class="text-muted">Performance ID: <strong>' . $performanceID . '</strong></p>';
                    echo '<div class="border rounded p-3 bg-white mb-3">';
                    echo nl2br(htmlspecialchars($row['remarks']));
                    echo '</div>';
                } else {
                    echo '<div class="alert alert-warning">No inbox message found for this performance ID.</div>';
                }

                // Back to Evaluation Page
                echo '<a href="?page=view_evaluate" class="btn btn-secondary">
                        <i class="fa fa-arrow-left"></i> Back to Evaluation Inbox
                      </a>';
            } else {
                echo '<div class="alert alert-danger">Invalid request type or missing ID.</div>';
            }
            ?>

        </div>
    </div>
</div>

</body>
</html>
