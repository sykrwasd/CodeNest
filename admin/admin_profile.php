<?php 
include('../config/database.php');

$adminID = $_SESSION['adminID'];

$viewQuery = $conn->prepare('SELECT * FROM admin WHERE adminID = ?');
$viewQuery->bind_param('s', $adminID); 
$viewQuery->execute();
$result = $viewQuery->get_result();

while ($row = $result->fetch_assoc()) {
?>


<div class="container my-4 p-4 border rounded shadow-sm" style="max-width: 700px;">
  <div class="text-center mb-4">
    <h2 class="mt-3" id="adminFullName"><?php echo htmlspecialchars($row['adminFullName']); ?></h2>
    <p class="text-muted">Administrator</p>
  </div>

  <form>
    <div class="row mb-3">
      <label class="col-sm-4 col-form-label fw-semibold">Admin ID</label>
      <div class="col-sm-8">
        <input type="text" readonly class="form-control-plaintext" value="<?php echo htmlspecialchars($row['adminID']); ?>">
      </div>
    </div>

    <div class="row mb-3">
      <label class="col-sm-4 col-form-label fw-semibold">Email</label>
      <div class="col-sm-8">
        <input type="email" readonly class="form-control-plaintext" value="<?php echo htmlspecialchars($row['adminEmail']); ?>">
      </div>
    </div>

    <div class="row mb-3">
      <label class="col-sm-4 col-form-label fw-semibold">Phone Number</label>
      <div class="col-sm-8">
        <input type="text" readonly class="form-control-plaintext" value="<?php echo htmlspecialchars($row['adminNoPhone']); ?>">
      </div>
    </div>

    <div class="row mb-3">
      <label class="col-sm-4 col-form-label fw-semibold">IC Number</label>
      <div class="col-sm-8">
        <input type="text" readonly class="form-control-plaintext" value="<?php echo htmlspecialchars($row['adminIC']); ?>">
      </div>
    </div>

    <div class="row mb-3">
      <label class="col-sm-4 col-form-label fw-semibold">Address</label>
      <div class="col-sm-8">
        <textarea readonly class="form-control-plaintext" rows="3"><?php echo htmlspecialchars($row['adminAddress']); ?></textarea>
      </div>
    </div>
  </form>
</div>


<?php } ?>
