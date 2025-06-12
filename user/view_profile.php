<?php 
include('../config/database.php');

$emailID = $_SESSION['userID'];

$viewQuery = $conn->prepare('SELECT * FROM staff WHERE staffID = ?');
$viewQuery->bind_param('s', $emailID); 
$viewQuery->execute();
$result = $viewQuery->get_result();

while ($row = $result->fetch_assoc()) {
?>

 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/view_staff.css">
<div class="container my-4 p-4 border rounded shadow-sm" style="max-width: 700px;">
  <div class="text-center mb-4">
    <img src="../img/<?php echo htmlspecialchars($row['staffPicture']); ?>" width="80" height="80" class="rounded" alt="Staff Picture">
    <h2 class="mt-3" id="staffFullName"><?php echo htmlspecialchars($row['staffFullName']); ?></h2>
    <p class="text-muted" id="staffDepartment"><?php echo htmlspecialchars($row['staffDepartment']); ?></p>
  </div>

  <form>
    <div class="row mb-3">
      <label for="staffID" class="col-sm-4 col-form-label fw-semibold">Staff ID</label>
      <div class="col-sm-8">
        <input type="text" readonly class="form-control-plaintext" id="staffID" value="<?php echo htmlspecialchars($row['staffID']); ?>">
      </div>
    </div>

    <div class="row mb-3">
      <label for="staffEmail" class="col-sm-4 col-form-label fw-semibold">Email</label>
      <div class="col-sm-8">
        <input type="email" readonly class="form-control-plaintext" id="staffEmail" value="<?php echo htmlspecialchars($row['staffEmail']); ?>">
      </div>
    </div>

    <div class="row mb-3">
      <label for="staffNoPhone" class="col-sm-4 col-form-label fw-semibold">Phone Number</label>
      <div class="col-sm-8">
        <input type="text" readonly class="form-control-plaintext" id="staffNoPhone" value="<?php echo htmlspecialchars($row['staffNoPhone']); ?>">
      </div>
    </div>

    <div class="row mb-3">
      <label for="staffDOB" class="col-sm-4 col-form-label fw-semibold">Date of Birth</label>
      <div class="col-sm-8">
        <input type="date" readonly class="form-control-plaintext" id="staffDOB" value="<?php echo htmlspecialchars($row['staffDOB']); ?>">
      </div>
    </div>

    <div class="row mb-3">
      <label for="staffIC" class="col-sm-4 col-form-label fw-semibold">IC Number</label>
      <div class="col-sm-8">
        <input type="text" readonly class="form-control-plaintext" id="staffIC" value="<?php echo htmlspecialchars($row['staffIC']); ?>">
      </div>
    </div>

    <div class="row mb-3">
      <label for="staffHireDate" class="col-sm-4 col-form-label fw-semibold">Hire Date</label>
      <div class="col-sm-8">
        <input type="date" readonly class="form-control-plaintext" id="staffHireDate" value="<?php echo htmlspecialchars($row['staffHireDate']); ?>">
      </div>
    </div>

    <div class="row mb-3">
      <label for="staffAddress" class="col-sm-4 col-form-label fw-semibold">Address</label>
      <div class="col-sm-8">
        <textarea readonly class="form-control-plaintext" id="staffAddress" rows="3"><?php echo htmlspecialchars($row['staffAddress']); ?></textarea>
      </div>
    </div>
  </form>
</div>

<?php } ?>
