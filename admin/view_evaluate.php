<?php 
include('../config/database.php');
$adminID = $_SESSION['userID'];

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
        echo "<script>alert('Evaluation submitted successfully.'); window.location.href = window.location.href;</script>";
    } else {
        echo "<script>alert('Database error: " . mysqli_error($conn) . "');</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
    crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.bootstrap5.min.css">
  <link rel="stylesheet" href="../css/view_staff.css">
</head>
<body>
    
<div class="container bg-white p-4 rounded shadow-sm">
    <h3 class="mb-4 text-center">All Staff Evaluations</h3>

    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle text-center" id="dataTable">
            <thead class="table-dark">
                <tr>
                    <th><i class="fa-solid fa-id-badge"></i> Evaluation ID</th>
                    <th><i class="fa-solid fa-user-tie"></i> Evaluator ID</th>
                    <th><i class="fa-solid fa-user"></i> Evaluatee ID</th>
                    <th><i class="fa-solid fa-calendar-days"></i> Date</th>
                    <th><i class="fa-solid fa-comments"></i> Remarks</th>
                    <th><i class="fa-solid fa-comments"></i> Evaluate</th>
                    <th><i class="fa-solid fa-circle-info"></i> Status</th>
                    <th><i class="fa-solid fa-gear"></i> Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $viewQuery = $conn->prepare('SELECT * FROM performance');
                $viewQuery->execute();
                $result = $viewQuery->get_result();

                while ($row = $result->fetch_assoc()) {
                ?>
                <tr>
                    <td><?php echo $row['performID']; ?></td>
                    <td><a href="admin_sidebar.php?page=view_staff"><?php echo $row['evaluatorID']; ?></a></td>
                    <td><?php echo $row['evaluateeID']; ?></td>
                    <td><?php echo $row['evaluateDate']; ?></td>
                    <td>
                        <button class="btn btn-primary btn-sm" data-bs-toggle="collapse" data-bs-target="#remarks<?php echo $row['performID']; ?>">View</button>
                        <div id="remarks<?php echo $row['performID']; ?>" class="collapse mt-2">
                            <textarea class="form-control" rows="5" readonly><?php echo $row['remarks']; ?></textarea>
                        </div>
                    </td>
                    <td>
                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
                             Evaluate
                            </button>
                    </td>
                    <td>
                        <span class="badge <?php echo $row['status'] == 'Read' ? 'bg-success' : 'bg-warning text-dark'; ?>">    
                            <?php echo $row['status']; ?>
                        </span>
                    </td>
                    <td class="d-flex justify-content-center gap-2">
                        <form action="../functions/update.php" method="post">
                            <input type="hidden" name="type" value="performance">
                            <input type="hidden" name="performID" value="<?php echo $row['performID']; ?>">
                            <button type="submit" name="mark_read" class="btn btn-success btn-sm">
                                <i class="fa-solid fa-check"></i>
                            </button>
                        </form>
                        <form action="../functions/delete.php" method="post">
                             <input type="hidden" name="type" value="performance">
                            <input type="hidden" name="performID" value="<?php echo $row['performID']; ?>">
                            <button type="submit" name="delete" class="btn btn-danger btn-sm">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

 <!-- Modal -->
  <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Staff Details</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="modalBody">
          <form method="POST" action="" enctype="multipart/form-data">
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="ev" class="form-label fw-semibold">Evaluator ID</label>
                    
                    <input type="text" class="form-control" name="ev" id="ev" required value="<?php echo $_SESSION['adminID'] ?>" readonly>
                </div>
               <div class="col-md-4">
                    <label for="id" class="form-label fw-semibold">Staff ID</label>
                    <input type="text" class="form-control" name="e" id="e" required>
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
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

</body>
     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    crossorigin="anonymous"></script>
  <script src="https://cdn.datatables.net/2.3.2/js/dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/2.3.2/js/dataTables.bootstrap5.min.js"></script>
  <script src="../js/script.js"></script>
  <script>

    new DataTable('#dataTable');
  </script>

</html>
