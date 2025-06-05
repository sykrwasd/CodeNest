<?php 

include('../config/database.php');

//print_r($_SESSION);

$adminID = $_SESSION['userID'];

?>

<!-- Add Font Awesome CDN in your page's <head> if not already included -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" 
      integrity="sha512-pO3Cz4PiODsjixgH0M3mqJe6Vrx/ovOW3BJ6Fx3Xy7eRO1THXt/1zLQ7u+XDfM80Rk8+3nj2yl1p8S2bW2E1Lg==" 
      crossorigin="anonymous" referrerpolicy="no-referrer" />

<div class="container bg-white p-4 rounded shadow-sm">
    <h3 class="mb-4 text-center">All Staff Requests</h3>

    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle text-center">
            <thead class="table-dark text-center">
                <tr>
                    <th><i class="fa-solid fa-id-badge"></i> Request ID</th>
                    <th><i class="fa-solid fa-user"></i> From</th>
                    <th><i class="fa-solid fa-envelope-open-text"></i> Request</th>
                    <th><i class="fa-solid fa-info-circle"></i> Status</th>
                    <th><i class="fa-solid fa-gear"></i> Action</th>
                </tr>
            </thead>
            <tbody id="requestTable">
                <?php 
                $viewQuery = $conn->prepare('SELECT * FROM request_updates');
                $viewQuery->execute();
                $result = $viewQuery->get_result();

                while ($row = $result->fetch_assoc()) {
                ?>
                <tr class="text-center">
                    <td><?php echo $row['requestID']; ?></td>
                    <td><a href="admin_sidebar.php?page=view_staff"><?php echo $row['staffID']; ?></a></td>
                    <td>
                        <button class="btn btn-primary btn-sm" data-bs-toggle="collapse" data-bs-target="#req<?= $row['requestID'] ?>">
                            <i class="fa-solid fa-eye"></i> View
                        </button>
                        <div id="req<?= $row['requestID'] ?>" class="collapse mt-2">
                            <textarea class="form-control" rows="10" readonly><?php echo $row['inbox']; ?></textarea>
                        </div>
                    </td>
                    <td>  <span class="badge <?php echo $row['status'] == 'Read' ? 'bg-success' : 'bg-warning text-dark'; ?>">
                            <?php echo $row['status']; ?>
                        </span></td>
                    <td style="display: flex; justify-content: center; align-items: center; gap: 10px;">
                       <form action="../functions/update.php" method="post" style="margin:0;">
                            <input type="hidden" name="type" value="request">
                            <input type="hidden" name="requestID" value="<?php echo $row['requestID'] ?>">
                            <button type="submit" name="mark_read" class="btn btn-success btn-sm">
                                <i class="fa-solid fa-check"></i> 
                            </button>
                        </form>
                       <form action="../functions/delete.php" method="post" style="margin:0;">
                            <input type="hidden" name="type" value="request">
                            <input type="hidden" name="requestID" value="<?php echo $row['requestID'] ?>">
                            <button type="submit" name="mark_read" class="btn btn-danger btn-sm">
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
