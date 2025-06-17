<?php 
include '../config/database.php'; 

?>

<!DOCTYPE html>
<html>
<head>
    <title>Payroll Generator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
     <link rel="stylesheet" href="../css/view_staff.css"> 
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

    <h2 style="text-align: center; margin-top: 20px;">Payroll Generator</h2>

    <div class="container mt-4">
        <form method="post" action="">
            <div class="row justify-content-center">
                <div class="col-3">
                    <div class="form-group">
                        <label for="date">Date</label>
                        <input type="date" class="form-control" name="date" required />
                    </div>
                </div>
            </div>
            <div class="row justify-content-center mt-3">
                <div class="col-2 text-center">
                    <button type="submit" class="btn btn-primary">Submit Payroll</button>
                </div>
            </div>
        </form>

       <?php
include '../config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['date'])) {
    $date = $_POST['date'];

    // Get all staff
    $staffQuery = mysqli_query($conn, "SELECT * FROM staff");

    echo "<table class='table table-bordered mt-5'>";
    echo "<thead class='table-dark'>
            <tr>
                <th>Staff ID</th>
                <th>Salary ID</th>
                <th>Gross Salary</th>
                <th>Deduction</th>
                <th>Net Salary</th>
            </tr>
          </thead>
          <tbody>";

    while ($staff = mysqli_fetch_array($staffQuery)) {
        $staffID = $staff['staffID'];

        // Get salary details for this staff
        $salaryQuery = $conn->prepare("SELECT * FROM salary WHERE staffID = ?");
        $salaryQuery->bind_param("i", $staffID);
        $salaryQuery->execute();
        $salaryResult = $salaryQuery->get_result();

        if ($salaryRow = $salaryResult->fetch_assoc()) {
            $salaryID = $salaryRow['salaryID'];
            $gross = $salaryRow['basicSalary'] + $salaryRow['allowance'];
            $deduction = ($gross * 0.11) + ($gross * 0.002) + ($gross * 0.005);
            $net = $gross - $deduction;

            // Avoid duplicate insert
            $check = $conn->prepare("SELECT * FROM payroll WHERE salaryID = ? AND payDate = ?");
            $check->bind_param("is", $salaryID, $date);
            $check->execute();
            $checkResult = $check->get_result();

            if ($checkResult->num_rows === 0) {
                $payrollID = rand(100000, 999999);
                $insert = $conn->prepare("INSERT INTO payroll (
                    payrollID, salaryID, payDate, bonus, deduction, netsalary, staffID
                ) VALUES (?, ?, ?, '0', '0', ?, ?)");
                $insert->bind_param("iisdi", $payrollID, $salaryID, $date, $net, $staffID);
                $insert->execute();
            }

            echo "<tr>";
            echo "<td>{$staffID}</td>";
            echo "<td>{$salaryID}</td>";
            echo "<td>" . number_format($gross, 2) . "</td>";
            echo "<td>" . number_format($deduction, 2) . "</td>";
            echo "<td>" . number_format($net, 2) . "</td>";
            echo "</tr>";
        }
    }

    echo "</tbody></table>";
}
?>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
</body>
</html>