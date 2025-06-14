<?php 
include('../config/database.php');



$payslipData = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $staffID = $_POST['id'];

    $sql = "SELECT * 
            FROM salary 
            INNER JOIN staff ON salary.staffID = staff.staffID 
            WHERE staff.staffID = '$staffID'";
    $result = mysqli_query($conn, $sql);

    if ($row = mysqli_fetch_assoc($result)) {
        $gross = $row['basicSalary'] + $row['allowance'];
        $kwsp = $gross * 0.11;
        $socso = $gross * 0.002;
        $eis = $gross * 0.005;
        $totalDeduction = $kwsp + $socso + $eis;
        $netSalary = $gross - $totalDeduction;

        $payslipData = [
            'staffID' => $row['staffID'],
            'staffFullName' => $row['staffFullName'],
            'staffDepartment' => $row['staffDepartment'],
            'staffHireDate' => $row['staffHireDate'],
            'basicSalary' => $row['basicSalary'],
            'allowance' => $row['allowance'],
            'gross' => $gross,
            'kwsp' => $kwsp,
            'socso' => $socso,
            'eis' => $eis,
            'totalDeduction' => $totalDeduction,
            'netSalary' => $netSalary,
        ];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Staff Payslip</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/view_staff.css">
</head>
<body>

    <!-- Staff Select Form -->
    <form action="" method="post" class="mb-4">
          <p>Select Staff</p>
        <select  name="id">
        <?php 
        
        $sql = "SELECT * FROM staff";
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result)){
            
            ?>
          <option value="<?php echo $row['staffID'] ?>"><?php echo $row['staffFullName'] ?> - <?php echo $row['staffID'] ?> </option>
    
          <?php }?>
        </select>
        <button type="submit" class="btn btn-primary">View Payslip</button>
    </form>

    <?php if ($payslipData): ?>
    <!-- Payslip Display -->
    <div class="border p-4 shadow-sm">
        <div class="text-center">
            <h3><?php echo 'Naza Sdn Bhd'; ?></h3>
            <h5 class="text-muted"><?php echo 'Payslip for ' . date("F Y"); ?></h5>
        </div>

        <h6><?php echo 'Employee Information'; ?></h6>
        <table class="table table-sm">
            <tr><td>Staff ID</td><td>: <?php echo $payslipData['staffID']; ?></td></tr>
            <tr><td>Name</td><td>: <?php echo $payslipData['staffFullName']; ?></td></tr>
            <tr><td>Department</td><td>: <?php echo $payslipData['staffDepartment']; ?></td></tr>
            <tr><td>Hire Date</td><td>: <?php echo $payslipData['staffHireDate']; ?></td></tr>
        </table>

        <h6><?php echo 'Earnings'; ?></h6>
        <table class="table table-bordered">
            <thead class="table-light">
                <tr><th>Description</th><th>Amount (RM)</th></tr>
            </thead>
            <tbody>
                <tr><td>Basic Salary</td><td><?php echo number_format($payslipData['basicSalary'], 2); ?></td></tr>
                <tr><td>Allowance</td><td><?php echo number_format($payslipData['allowance'], 2); ?></td></tr>
                <tr class="table-success"><td><strong>Total Gross</strong></td><td><strong><?php echo number_format($payslipData['gross'], 2); ?></strong></td></tr>
            </tbody>
        </table>

        <h6><?php echo 'Deductions'; ?></h6>
        <table class="table table-bordered">
            <thead class="table-light">
                <tr><th>Description</th><th>Amount (RM)</th></tr>
            </thead>
            <tbody>
                <tr><td>KWSP (11%)</td><td><?php echo number_format($payslipData['kwsp'], 2); ?></td></tr>
                <tr><td>SOCSO (0.2%)</td><td><?php echo number_format($payslipData['socso'], 2); ?></td></tr>
                <tr><td>EIS (0.5%)</td><td><?php echo number_format($payslipData['eis'], 2); ?></td></tr>
                <tr class="table-danger"><td><strong>Total Deduction</strong></td><td><strong><?php echo number_format($payslipData['totalDeduction'], 2); ?></strong></td></tr>
            </tbody>
        </table>

        <h6><?php echo 'Net Salary'; ?></h6>
        <p class="fw-bold fs-5">RM <?php echo number_format($payslipData['netSalary'], 2); ?></p>
    </div>
    <?php endif; ?>

</body>
</html>
