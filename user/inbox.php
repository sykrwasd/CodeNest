<?php

include('../config/database.php');

$staffID = $_SESSION['userID'];


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        crossorigin="anonymous">
    <link rel="stylesheet" href="../css/view_staff.css">
</head>

<body>

    <div class="container bg-white p-4 rounded shadow-sm">
        <h3 class="mb-4 text-center">Inbox</h3>

        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle text-center" id="dataTable">
                <thead class="table-dark text-center">
                    <tr>
                        <th><i class="fa-solid fa-id-badge"></i> Request ID</th>
                        <th><i class="fa-solid fa-envelope-open-text"></i> Request</th>
                        <th><i class="fa-solid fa-info-circle"></i> Status</th>
                    </tr>
                </thead>
                <tbody id="requestTable">
                    <?php
                    $viewQuery = $conn->prepare('SELECT * FROM request_updates WHERE staffID = ?');
                    $viewQuery->bind_param("i", $staffID);
                    $viewQuery->execute();
                    $result = $viewQuery->get_result();

                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <tr class="text-center">
                            <td><?php echo $row['requestID']; ?></td>
                            <td>
                                <form action="?page=view_inbox" method="POST">
                                    <input type="hidden" name="requestID" value="<?php echo $row['requestID'] ?>">
                                    <input type="hidden" name="type" value="request">
                                    <button type="submit" class="btn btn-sm btn-primary">
                                        <i class="fa-solid fa-eye"></i> View
                                    </button>
                                </form>

                            </td>
                            <td> <span
                                    class="badge <?php echo $row['status'] == 'Read' ? 'bg-success' : 'bg-warning text-dark'; ?>">
                                    <?php echo $row['status']; ?>
                                </span></td>


                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>


    </div>

    <div class="container bg-white p-4 rounded shadow-sm">

        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle text-center" id="dataTable">
                <thead class="table-dark text-center">
                    <tr>
                        <th><i class="fa-solid fa-id-badge"></i> Evaluate ID</th>
                        <th><i class="fa-solid fa-id-badge"></i> Evaluater ID</th>
                        <th><i class="fa-solid fa-id-badge"></i> Evaluatee ID</th>
                        <th><i class="fa-solid fa-envelope-open-text"></i> Admin Remarks</th>
                    </tr>
                </thead>
                <tbody id="requestTable">
                    <?php
                    $viewQuery = $conn->prepare(
                        'SELECT p.* FROM performance p
                                INNER JOIN admin a ON p.evaluatorID = a.adminID
                                WHERE p.evaluateeID = ?'
                    );
                    $viewQuery->bind_param("i", $staffID);
                    $viewQuery->execute();
                    $result = $viewQuery->get_result();

                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <tr class="text-center">
                            <td><?php echo $row['performID']; ?></td>
                            <td><?php echo $row['evaluatorID']; ?></td>
                            <td><?php echo $row['evaluateeID']; ?></td>
                            <td>
                                <form action="?page=view_inbox" method="POST">
                                    <input type="hidden" name="performID" value="<?php echo $row['performID'] ?>">
                                    <input type="hidden" name="type" value="performance">
                                    <button type="submit" class="btn btn-sm btn-primary">
                                        <i class="fa-solid fa-eye"></i> View
                                    </button>
                                </form>

                            </td>



                        </tr>
                    <?php } ?>
                </tbody>
            </table>
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

<!-- Add Font Awesome CDN in your page's <head> if not already included -->