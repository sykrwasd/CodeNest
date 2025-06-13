<?php include '../config/database.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Payroll Generator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
     <link rel="stylesheet" href="../css/view_staff.css"> 
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
        // Jalankan hanya jika borang dihantar
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['date'])) {
            $date = $_POST['date'];
            $sql = "SELECT * FROM salary";
            $query = mysqli_query($conn, $sql);

            echo "<table class='table table-bordered mt-5'>";
            echo "<thead class='table-dark'>
                    <tr>
                        <th>Salary ID</th>
                        <th>Gross Salary</th>
                        <th>Deduction</th>
                        <th>Net Salary</th>
                        <th>Staff ID</th>
                    </tr>
                  </thead>
                  <tbody>";

            while ($siswa = mysqli_fetch_array($query)) {
                $payrollID = rand(100000, 999999);
                $gross = $siswa['basicSalary'] + $siswa['allowance'];
                $deduction = ($gross * 0.11) + ($gross * 0.12) + ($gross * 0.13);
                $net = $gross - $deduction;

                // Insert ke dalam jadual payroll
                $insert = "INSERT INTO payroll (
                    payrollID, salaryID, payDate, bonus, deduction, netsalary, staffID
                ) VALUES (
                    '$payrollID', '".$siswa['salaryID']."', '$date', '0', '0', '$net', '".$siswa['staffID']."'
                )";
                mysqli_query($conn, $insert);

                echo "<tr>";
                echo "<td>".$siswa['salaryID']."</td>";
                echo "<td>".number_format($gross, 2)."</td>";
                echo "<td>".number_format($deduction, 2)."</td>";
                echo "<td>".number_format($net, 2)."</td>";
                echo "<td>".$siswa['staffID']."</td>";
                echo "</tr>";
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