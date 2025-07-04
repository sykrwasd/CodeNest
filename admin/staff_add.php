<?php
include '../config/database.php';
$staffID = 2025 . rand(100000, 999999); // staffID
$salaryID = rand(100000, 999999); // staffID
$randomEmail = $staffID . '@nazacorp.com';
$payrollID = rand(100000, 999999); // payrollID
$performanceID = rand(100000, 999999); // performanceID
$updateID = rand(100000, 999999); // updateID
$departmentID = rand(100000, 999999); // departmentID




if ($_SERVER['REQUEST_METHOD'] === 'POST') {


  // Getting staff info
  $firstname = $_POST['fname'];
  $lastname = $_POST['lname'];
  $fullname = $firstname . ' ' . $lastname;

  $dob = $_POST['dob'];
  $pnum = $_POST['pnum'];
  $email = $randomEmail;
  $role = $_POST['role'];
  $department = $_POST['department'];
  $staffIC = $_POST['staffIC']; // staffIC
  $salary = $_POST['salary'];

  $address1 = $_POST['address1'];
  $address2 = $_POST['address2'];
  $postcode = $_POST['postcode'];
  $state = $_POST['state'];
  $country = $_POST['country'];
  $fulladdress = $address1 . ' ' . $address2 . ' ' . $postcode . ' ' . $state . ' ' . $country;

  $hireDate = date('Y-m-d');

  // Handle image upload
  $targetDir = "../img/";
  $imageName = preg_replace("/[^a-zA-Z0-9]/", "", $firstname . $lastname) . ".jpg";
  $targetFile = $targetDir . $imageName;

  $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

  // Only allow JPG files
  if ($imageFileType !== "jpg") {
    die("Only JPG files are allowed.");
  }

  if (move_uploaded_file($_FILES["picture"]["tmp_name"], $targetFile)) {
    // File uploaded successfully

    // Insert staff
    $insertStaff = $conn->prepare("INSERT INTO staff (
    staffEmail, staffID, staffFullName, staffNoPhone, staffAddress, 
    staffDOB, staffIC, staffHireDate, staffPicture
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $insertStaff->bind_param("sisssssss", $email, $staffID, $fullname, $pnum, $fulladdress, $dob, $staffIC, $hireDate, $imageName);

    // Insert salary
    $insertSalary = $conn->prepare("INSERT INTO salary (
    salaryID, basicSalary, allowance, staffID
  ) VALUES (?, ?, ?, ?)");
    $allowance = 100;
    $insertSalary->bind_param("iddi", $salaryID, $salary, $allowance, $staffID);

    // Insert user
    $insertUser = $conn->prepare("INSERT INTO user (
    userEmail, userID, userPassword, category
) VALUES (?, ?, ?, ?)");
    $userPassword = 'newuser';
    $category = 'staff';
    $insertUser->bind_param("ssss", $email, $staffID, $userPassword, $category);

    $insertSd = $conn->prepare("INSERT INTO staff_department (
    staffID, departmentID
) VALUES (?, ?)");
    $insertSd->bind_param("is", $staffID, $departmentID);


    // Insert payroll
    /*$insertPayroll = $conn->prepare("INSERT INTO payroll (
    payrollID, salaryID, payDate, bonus, deduction, netsalary, staffID
) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $payDate = '0';
    $bonus = 0;
    $deduction = 0;
    $netsalary = 0;
    $insertPayroll->bind_param("iissddi", $payrollID, $salaryID, $payDate, $bonus, $deduction, $netsalary, $staffID);*/

    // Insert performance
//     $insertPerformance = $conn->prepare("INSERT INTO performance (
//     performID, staffID, evaluatorName, evaluateDate, remarks, status
// ) VALUES (?, ?, ?, ?, ?, ?)");
//     $evaluatorName = '0';
//     $evaluateDate = '0';
//     $remarks = '0';
//     $status = '0';
//     $insertPerformance->bind_param("iissss", $performanceID, $staffID, $evaluatorName, $evaluateDate, $remarks, $status);

    // Insert request update
//     $insertUpdate = $conn->prepare("INSERT INTO request_update (
//     updateID, inbox, status, staffID, adminID
// ) VALUES (?, ?, ?, ?)");
//     $inbox = '0';
//     $updateStatus = '0';
//     $adminIDrequest = '0';
//     $insertUpdate->bind_param("issii", $updateID, $inbox, $updateStatus,$staffID, $adminIDrequest);

    // Insert department
    $insertDepartment = $conn->prepare("INSERT INTO department (
    departmentID, departmentType, role
) VALUES (?, ?, ?)");
    $insertDepartment->bind_param("iss", $departmentID, $department, $role);

    // Execute all
    $staffResult = $insertStaff->execute();
    $salaryResult = $insertSalary->execute();
    $userResult = $insertUser->execute();
    $sdResult = $insertSd->execute();
    $departmentResult = $insertDepartment->execute();







    if ($staffResult && $salaryResult && $userResult && $sdResult  && $departmentResult) {
      echo "<html>
    <head>
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <link rel='stylesheet' href='../css/view_staff.css'>
    </head>
    <body>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Added',
                text: 'Staff successfully Added',
                confirmButtonText: 'Back'
            }).then(() => {
                window.history.back();
            });
        </script>
    </body>
    </html>";
    } else {
      echo "<script>alert('Database Error: " . mysqli_error($conn) . "');</script>";
    }

  } else {
    echo "Sorry, there was an error uploading the picture.";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Staff</title>
  <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/sidebar.css">
  <link rel="stylesheet" href="../css/staff_add.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

  <h2 class="text-center mb-4">Staff Registration</h2>

  <div class="container my-4">
    <div class="row justify-content-center">
      <div class="col-lg-10">
        <div class="card p-4" >
          <form method="post" enctype="multipart/form-data" action="">

            <div class="row mb-3">
              <div class="col-md-4">
                <label for="firstName" class="form-label">First Name</label>
                <input type="text" class="form-control" name="fname" id="firstName" placeholder="First Name" required>
              </div>
              <div class="col-md-4">
                <label for="lastName" class="form-label">Last Name</label>
                <input type="text" class="form-control" name="lname" id="lastName" placeholder="Last Name" required>
              </div>
              <div class="col-md-4">
                <label for="dob" class="form-label">Date of Birth</label>
                <input type="date" class="form-control" name="dob" id="dob" required>
              </div>
            </div>

            <div class="row mb-3">
              <div class="col-md-4">
                <label for="phone" class="form-label">Phone Number</label>
                <input type="text" class="form-control" name="pnum" id="phone" placeholder="Phone Number" required>
              </div>
              <div class="col-md-4">
                <label for="email" class="form-label">Company Email</label>
                <input type="email" class="form-control" name="email" id="email" value="<?php echo $randomEmail ?>" readonly>
              </div>
              <div class="col-md-4">
                <label for="department" class="form-label">Department</label>
                <select class="form-select" name="department" id="department" required>
                  <option selected disabled>Choose Department</option>
                  <option value="Sales">Sales</option>
                  <option value="Accounting">Accounting</option>
                  <option value="Marketing">Marketing</option>
                </select>
              </div>
            </div>

            <div class="row mb-3">
              <div class="col-md-4">
                <label for="role" class="form-label">Role</label>
                <select class="form-select" name="role" id="role" required>
                  <option selected disabled>Choose Role</option>
                  <optgroup label="Sales">
                    <option value="Sales Manager">Manager</option>
                    <option value="Sales Operator">Operator</option>
                    <option value="Sales Customer Service">Customer Services</option>
                  </optgroup>
                  <optgroup label="Accounting">
                    <option value="Accounting Executive">Executive</option>
                    <option value="Accounting Auditor">Auditor</option>
                  </optgroup>
                  <optgroup label="Marketing">
                    <option value="Marketing Manager">Manager</option>
                    <option value="Marketing Promoter">Promoter</option>
                  </optgroup>
                </select>
              </div>
              <div class="col-md-4">
                <label for="staffIC" class="form-label">Staff IC</label>
                <input type="text" class="form-control" name="staffIC" id="staffIC" placeholder="Eg: XXXX-XX-XXXX" required>
              </div>
              <div class="col-md-4">
                <label for="salary" class="form-label">Salary (RM)</label>
                <input type="number" class="form-control" name="salary" id="salary" required>
              </div>
            </div>

            <div class="row mb-3">
              <div class="col-md-6">
                <label for="picture" class="form-label">Picture (.jpg)</label>
                <input type="file" class="form-control" name="picture" id="picture" accept=".jpg" required>
              </div>
            </div>

            <div class="row mb-3">
              <div class="col-md-12">
                <label for="address1" class="form-label">Address Line 1</label>
                <input type="text" class="form-control" name="address1" id="address1" placeholder="Address Line 1" required>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-md-12">
                <input type="text" class="form-control" name="address2" id="address2" placeholder="Address Line 2 (Optional)">
              </div>
            </div>

            <div class="row mb-4">
              <div class="col-md-4">
                <label for="postcode" class="form-label">Postcode</label>
                <input type="text" class="form-control" name="postcode" id="postcode" placeholder="Postcode" required>
              </div>
              <div class="col-md-4">
                <label for="state" class="form-label">State</label>
                <input type="text" class="form-control" name="state" id="state" placeholder="State" required>
              </div>
              <div class="col-md-4">
                <label for="country" class="form-label">Country</label>
                <input type="text" class="form-control" name="country" id="country" placeholder="Country" required>
              </div>
            </div>

            <div class="text-center">
              <button type="submit" class="btn btn-primary">Add Staff</button>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>