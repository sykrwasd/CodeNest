<?php
include('../config/database.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Staff List</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
    crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.bootstrap5.min.css">
  <link rel="stylesheet" href="../css/view_staff.css">
</head>

<body>
  <div class="container mt-4">
    <h2 class="text-center mb-4">Staff List</h2>
    <table id="dataTable" class="table table-bordered table-hover staff-table">
      <thead class="table-primary text-center">
        <tr>
          <th><i class="fa-solid fa-image"></i> Staff Image</th>
          <th><i class="fa-solid fa-user"></i> Full Name</th>
          <th><i class="fa-solid fa-phone"></i> Phone Number</th>
          <th><i class="fa-solid fa-envelope"></i> Company Email</th>
          <th><i class="fa-solid fa-calendar-days"></i> Hire Date</th>
          <th><i class="fa-solid fa-gear"></i> Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $viewQuery = $conn->prepare('SELECT * from staff');
        $viewQuery->execute();
        $result = $viewQuery->get_result();
        while ($row = $result->fetch_assoc()) {
        ?>
          <tr>
            <td><img src="../img/<?php echo $row['staffPicture']; ?>" width="90" height="90" /></td>
            <td><?php echo $row['staffFullName']; ?></td>
            <td><?php echo $row['staffNoPhone']; ?></td>
            <td><?php echo $row['staffEmail']; ?></td>
            <td><?php echo $row['staffHireDate']; ?></td>
            <td class="text-center">
              <form action="../functions/update.php" method="post" class="d-inline-block">
                <input type="hidden" name="type" value="staff">
                <button type="submit" name="mark_read" class="btn btn-success btn-sm">
                  <i class="fa-solid fa-pen"></i>
                </button>
              </form>
              <form action="delete_request.php" method="post" class="d-inline-block">
                <input type="hidden" name="updateID" value="<?php echo $row['updateID'] ?>">
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

  <div class="text-center my-3">
    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
      <i class="fa-solid fa-eye"></i> View Full Details
    </button>
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
          <table id="staffModalTable" class="table table-bordered table-hover staff-table">
            <thead class="table-primary text-center">
              <tr>
                <th><i class="fa-solid fa-image"></i> Staff Image</th>
                <th><i class="fa-solid fa-location-dot"></i> Address</th>
                <th><i class="fa-solid fa-cake-candles"></i> Date of Birth</th>
                <th><i class="fa-solid fa-id-card"></i> IC</th>
                <th><i class="fa-solid fa-building-user"></i> Department</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $viewQuery = $conn->prepare('SELECT * from staff');
              $viewQuery->execute();
              $result = $viewQuery->get_result();
              while ($row = $result->fetch_assoc()) {
              ?>
                <tr>
                  <td><img src="../img/<?php echo $row['staffPicture']; ?>" width="90" height="90" /></td>
                  <td><?php echo $row['staffAddress']; ?></td>
                  <td><?php echo $row['staffDOB']; ?></td>
                  <td><?php echo $row['staffIC']; ?></td>
                  <td><?php echo $row['staffDepartment']; ?></td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <!-- JS Dependencies -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    crossorigin="anonymous"></script>
  <script src="https://cdn.datatables.net/2.3.2/js/dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/2.3.2/js/dataTables.bootstrap5.min.js"></script>
  <script src="../js/script.js"></script>
  <script>

    new DataTable('#dataTable');
  </script>


  
</body>

</html>
