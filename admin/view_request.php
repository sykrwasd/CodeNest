<?php 

session_start();
include('../config/database.php');

//print_r($_SESSION);


$adminID = $_SESSION['adminID'];


?>

<div class="container bg-white p-4 rounded shadow-sm">
    <h3 class="mb-4 text-center">All Staff Requests</h3>

    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle text-center">
            <thead class="table-dark text-center">
                <tr>
                    <th>Update ID</th>
                    <th>From</th>
                    <th>Request</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="requestTable">
                <?php 
                $viewQuery = $conn->prepare('SELECT * FROM request_updates WHERE adminID = ?');
                $viewQuery->bind_param('s', $adminID); 
                $viewQuery->execute();
                $result = $viewQuery->get_result();

                while ($row = $result->fetch_assoc()) {
                ?>
                <tr class="text-center">
                    <td><?php echo $row['updateID']; ?></td>
                    <td><a href="admin_sidebar.php?page=view_staff"><?php echo $row['staffID']; ?></a></td>
                    <td>
                        <button class="btn btn-primary btn-sm" data-bs-toggle="collapse" data-bs-target="#req<?= $row['updateID'] ?>">View</button>
                        <div id="req<?= $row['updateID'] ?>" class="collapse mt-2">
                            <textarea class="form-control" rows="10" readonly><?php echo $row['inbox']; ?></textarea>
                        </div>
                    </td>
                    <td><?php echo $row['status']; ?></td>
                    <td style="display: flex; justify-content: center; align-items: center; gap: 10px;">
                       <form action="update_request.php" method="post" >
                            <input type="hidden" name="updateID" value="<?php echo $row['updateID'] ?>">
                            <button type="submit" name="mark_read" class="btn btn-success">Mark as Read</button>
                        </form>
                       <form action="delete_request.php" method="post" >
                            <input type="hidden" name="updateID" value="<?php echo $row['updateID'] ?>">
                            <button type="submit" name="mark_read" class="btn btn-danger">Delete</button>
                        </form>
                    </td>   
                    
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
