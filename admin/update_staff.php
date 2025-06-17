<?php
include('../config/database.php');

$staffID = $_POST['staffID'];
$viewQuery = $conn->prepare('SELECT * FROM staff WHERE staffID = ?');
$viewQuery->bind_param('s', $staffID); 
$viewQuery->execute();
$result = $viewQuery->get_result();

while ($row = $result->fetch_assoc()){

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Staff List</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.bootstrap5.min.css">
  <link rel="stylesheet" href="../css/view_staff.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

<div class="container">
  <!-- Select Staff Card -->
  
  <?php if (!empty($row)): ?>
  <div class="card shadow">
    <div class="card-header bg-success text-white">
      <h5 class="mb-0">Staff Detail</h5>
    </div>
    <div class="card-body">
      <form method="post" action="../functions/update.php" enctype="multipart/form-data">
        <input type="hidden" name="type" value="staff">


        <div class="row mb-3">
          <div class="col-md-6">
            <label for="firstName" class="form-label">Staff Name</label>
            <input type="text" class="form-control" name="fname" id="firstName" value="<?= $row['staffFullName']; ?>">
          </div>
          <div class="col-md-6">
            <label for="dob" class="form-label">Date of Birth</label>
            <input type="date" class="form-control" name="dob" id="dob" value="<?= $row['dob']; ?>">
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-md-4">
            <label for="phone" class="form-label">Phone Number</label>
            <input type="text" class="form-control" name="pnum" id="phone" value="<?= $row['staffNoPhone']; ?>">
          </div>
          <div class="col-md-5">
            <label for="email" class="form-label">Company Email</label>
            <input type="email" class="form-control" name="email" id="email" value="<?= $row['staffEmail']; ?>" readonly>
          </div>
          <div class="col-md-3">
            <label for="department" class="form-label">Department</label>
            <select class="form-select" name="department" id="department">
              <option disabled>Select Department</option>
              <?php
              $departments = ['Sales', 'Accounting', 'Marketing'];
              foreach ($departments as $dept) {
                  $selected = ($row['staffDepartment'] === $dept) ? "selected" : "";
                  echo "<option value='$dept' $selected>$dept</option>";
              }
              ?>
            </select>
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-md-4">
            <label for="staffIC" class="form-label">Staff IC</label>
            <input type="text" class="form-control" name="staffIC" id="staffIC" value="<?= $row['staffIC']; ?>" readonly>
          </div>
          <div class="col-md-8">
            <label for="address1" class="form-label">Address</label>
            <input type="text" class="form-control" name="address1" id="address1" value="<?= $row['staffAddress']; ?>">
          </div>
        </div>

        <div class="text-end">
          <button class="btn btn-success" type="submit">Update</button>
        </div>
      </form>
    </div>
  </div>
  <?php 
  endif;
  } 
  ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/2.3.2/js/dataTables.min.js"></script>
<script src="https://cdn.datatables.net/2.3.2/js/dataTables.bootstrap5.min.js"></script>
</body>
</html>
