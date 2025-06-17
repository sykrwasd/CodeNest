<?php
include '../config/database.php';

//print_r($_SESSION);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $performanceID = rand(100000,999999);
    $evaluatorID = $_POST['ev'];
    $evaluateeID = $_POST['e'];
    $evaluateDate = $_POST['date'];
    $remarks = $_POST['remark'];
    $status = 'Unchecked';

    $insertPerformance = "INSERT INTO performance (
        performID, evaluatorID, evaluateeID, evaluateDate, remarks, status
    ) VALUES (
        '$performanceID', '$evaluatorID', '$evaluateeID', '$evaluateDate', '$remarks', '$status'
    )";

    $performanceResult = mysqli_query($conn, $insertPerformance);

    if ($performanceResult) {
        echo "<html>
    <head>
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <link rel='stylesheet' href='../css/view_staff.css'>
    </head>
    <body>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Added',
                text: 'Evaluation successfully Added',
                confirmButtonText: 'Back'
            }).then(() => {
                window.history.back();
            });
        </script>
    </body>
    </html>";
    } else {
        echo "<script>alert('Database error: " . mysqli_error($conn) . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Evaluation Survey</title>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/view_staff.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="container p-4 border rounded shadow-sm bg-white mt-5" style="max-width: 900px;">
        <h4 class="text-center mb-4">Evaluation Survey Form</h4>

        <form method="POST" action="" enctype="multipart/form-data">
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="ev" class="form-label fw-semibold">Evaluator ID</label>
                    
                    <input type="text" class="form-control" name="ev" id="ev" required value="<?php echo $_SESSION['staffID'] ?>" readonly>
                </div>
                <div class="col-md-4">
                    <label for="e" class="form-label fw-semibold">Evaluatee ID</label>
                     <select class="form-select" name="e" >
                            <option disabled selected>Staff</option>
                            <?php 
                            $viewQuery = $conn->prepare('SELECT * FROM staff');
                            $viewQuery->execute();
                            $result = $viewQuery->get_result();
                            while ($row = $result->fetch_assoc()) {
                            ?>
                            <option value="<?php echo $row['staffID']; ?>">
                                <?php echo $row['staffFullName']; ?>
                            </option>
                            <?php }?>
                        </select>
                  
                </div>
                <div class="col-md-4">
                    <label for="date" class="form-label fw-semibold">Evaluation Date</label>
                    <input type="date" class="form-control" name="date" id="date" required>
                </div>
            </div>

            <div class="mb-3">
                <label for="remark" class="form-label fw-semibold">Comment / Remarks</label>
                <textarea class="form-control" name="remark" id="remark" rows="5" placeholder="Write your remarks here..." required></textarea>
            </div>

            <div class="text-end">
                <button type="submit" class="btn btn-primary">Submit Evaluation</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../asset/sidebar.js"></script>
</body>
</html>
