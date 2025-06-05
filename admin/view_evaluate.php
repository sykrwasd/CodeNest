<?php 
include('../config/database.php');
$adminID = $_SESSION['userID'];
?>

<div class="container bg-white p-4 rounded shadow-sm">
    <h3 class="mb-4 text-center">All Staff Evaluations</h3>

    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle text-center">
            <thead class="table-dark">
                <tr>
                    <th><i class="fa-solid fa-id-badge"></i> Evaluation ID</th>
                    <th><i class="fa-solid fa-user-tie"></i> Evaluator ID</th>
                    <th><i class="fa-solid fa-user"></i> Evaluatee ID</th>
                    <th><i class="fa-solid fa-calendar-days"></i> Date</th>
                    <th><i class="fa-solid fa-comments"></i> Remarks</th>
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
