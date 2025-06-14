<?php include '../config/database.php'; ?>


<?php
$id = $_SESSION['staffID'];
//print_r($_SESSION);
$sql = "SELECT * 
        FROM salary 
        INNER JOIN staff ON salary.staffID = staff.staffID 
        WHERE staff.staffID = '$id'";
$query = mysqli_query($conn, $sql);

while($row = mysqli_fetch_array($query)) {
    $gross = $row['basicSalary'] + $row['allowance'];
    $kwsp = $gross * 0.11;
    $socso = $gross * 0.002;
    $eis = $gross * 0.005;
    $totalDeduction = $kwsp + $socso + $eis;
    $netSalary = $gross - $totalDeduction;
?>
<!DOCTYPE html>
<html>
<head>
    <title>Payslip - Naza Sdn Bhd</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/view_staff.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" 
    integrity="sha512-pO3Cz4PiODsjixgH0M3mqJe6Vrx/ovOW3BJ6Fx3Xy7eRO1THXt/1zLQ7u+XDfM80Rk8+3nj2yl1p8S2bW2E1Lg==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
</head>
<body>
    <div class="container ">
    <div class="border p-4 shadow-sm">
        <div class="text-center">
            <h3>Naza Sdn Bhd</h3>
            <h5 class="text-muted">Payslip for <?php echo date("F Y"); ?></h5>
        </div>

        <div class="mb-4">
            <h6>Employee Information</h6>
            <table class="table table-sm">
                <tr><td>Staff ID</td><td>: <?php echo $row['staffID']; ?></td></tr>
                <tr><td>Name</td><td>: <?php echo $row['staffFullName']; ?></td></tr>
                <tr><td>Department</td><td>: <?php echo $row['staffDepartment']; ?></td></tr>
                <tr><td>Hire Date</td><td>: <?php echo $row['staffHireDate']; ?></td></tr>
            </table>
        </div>

        <div class="mb-4">
            <h6>Earnings</h6>
            <table class="table table-bordered">
                <thead class="table-light">
                    <tr><th>Description</th><th>Amount (RM)</th></tr>
                </thead>
                <tbody>
                    <tr><td>Basic Salary</td><td><?php echo number_format($row['basicSalary'], 2); ?></td></tr>
                    <tr><td>Allowance</td><td><?php echo number_format($row['allowance'], 2); ?></td></tr>
                    <tr class="table-success"><td><strong>Total Gross</strong></td><td><strong><?php echo number_format($gross, 2); ?></strong></td></tr>
                </tbody>
            </table>
        </div>

        <div class="mb-4">
            <h6>Deductions</h6>
            <table class="table table-bordered">
                <thead class="table-light">
                    <tr><th>Description</th><th>Amount (RM)</th></tr>
                </thead>
                <tbody>
                    <tr><td>KWSP (11%)</td><td><?php echo number_format($kwsp, 2); ?></td></tr>
                    <tr><td>SOCSO (0.2%)</td><td><?php echo number_format($socso, 2); ?></td></tr>
                    <tr><td>EIS (0.5%)</td><td><?php echo number_format($eis, 2); ?></td></tr>
                    <tr class="table-danger"><td><strong>Total Deduction</strong></td><td><strong><?php echo number_format($totalDeduction, 2); ?></strong></td></tr>
                </tbody>
            </table>
        </div>

        <div class="mb-2">
            <h6>Net Salary</h6>
            <p class="fw-bold fs-5">RM <?php echo number_format($netSalary, 2); ?></p>
        </div>
    </div>
</div>

<?php } ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>    
</body>

</html>
