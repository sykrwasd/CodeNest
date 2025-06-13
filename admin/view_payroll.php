<?php 
// print_r($_SESSION  );
// echo $staffID;


include('../config/database.php');
$staffID = $_SESSION['staffID'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Staff List by Month</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/view_staff.css">
</head>
<body >

  <!-- Month/Year Slider -->
 <div class="d-flex justify-content-between align-items-center px-4 py-3 bg-light border-bottom">
    <button class="btn btn-outline-primary btn-sm" id="prevMonth">&lt;</button>
    <input type="hidden" value="<?php echo $staffID?>" id="staffid">
    <input type="hidden" value="admin" id="page">
    <h4 id="monthLabel" class="m-0">June 2025</h4>
    <button class="btn btn-outline-primary btn-sm" id="nextMonth">&gt;</button>
  </div>

  <!-- Staff Table -->
  <!-- Payslip Display -->
      <div class="container mt-4 "  id="payslipContainer">
       <!-- <div class="card shadow">
    <div class="card-header bg-primary text-white">
      <h5 class="mb-0">Slip Gaji - <span id="displayMonth">June 2025</span></h5>
    </div>
    <div class="card-body">
      <table class="table table-borderless">
        <tr><th>Nama Pekerja:</th><td id="empName">Umar Syakir</td></tr>
        <tr><th>Jawatan:</th><td id="empPosition">Software Developer</td></tr>
        <tr><th>Gaji Pokok:</th><td id="basicSalary">RM 3,500</td></tr>
        <tr><th>Elaun:</th><td id="allowance">RM 300</td></tr>
        <tr><th>Potongan:</th><td id="deductions">RM 250</td></tr>
        <tr class="table-primary">
          <th>Gaji Bersih:</th><td id="netSalary">RM 3,550</td>
        </tr>
      </table>
    </div>
    <div class="card-footer text-end">
      <button class="btn btn-outline-secondary btn-sm" onclick="window.print()">Cetak Slip</button>
    </div>
  </div> -->
  
      </div>
      <div class="card-footer text-end">
      

    </div>
      

  <script src="../js/script.js"></script>

</body>
</html>
