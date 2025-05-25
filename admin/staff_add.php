<?php
include '../config/database.php';
$random = 2025 . rand(100000,999999); // staffID
$random2 = rand(100000,999999); // staffID
$randomEmail = $random . '@nazacorp.com';



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
    $citizen = $_POST['citizen']; // staffIC
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

        // Insert into new schema
        $insertStaff = "INSERT INTO staff (
            staffEmail, staffID, staffFullName, staffNoPhone, staffAddress, 
            staffDOB, staffIC, staffHireDate, staffDepartment, staffRole, staffPicture
        ) VALUES (
            '$email', '$random', '$fullname', '$pnum', '$fulladdress',
            '$dob', '$citizen', '$hireDate', '$department', '$role', '$imageName'
        )";

         $insertSalary = "INSERT INTO salary (
           salaryID, basicSalary,	allowance,	staffID
        ) VALUES (
           '$random2', '$salary', '100', '$email'
        )";

         $insertUser = "INSERT INTO user (
           userEmail, userPassword,	category
        ) VALUES (
           '$email','newuser','staff'
        )";

        $result = mysqli_query($conn, $insertStaff);
        $result2 = mysqli_query($conn, $insertSalary);
        $result3 = mysqli_query($conn, $insertUser);

        if ($result) {
            echo "<script>alert('Staff Added Successfully');
            window.history.back();
            </script>";
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
    <title>Sidebar With Bootstrap</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/sidebar.css">
    <link rel="stylesheet" href="../css/staff_add.css">
    
</head>

<body>
   
              <h2 style="text-align: center; margin-top: 0px;"> Staff Registration</h2>
                <div class="container">
                
                  <form method="post" action="" enctype="multipart/form-data">


                      <div class="row justify-content-center">
                        <div class="col-3">
                          <div class="form-group">
                            <label for="firstName">First Name</label>
                            <input type="text" class="form-control" name="fname" id="firstName" placeholder="First Name" />
                          </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                              <label for="lastName">Last Name</label>
                              <input type="text" class="form-control" name="lname" id="lastName" placeholder="Last Name" />
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                              <label for="dob">Date of Birth</label>
                              <input type="date" class="form-control" name="dob" id="dob" />
                            </div>
                        </div>
                      </div>

                      <div class="row justify-content-center mt-4">
                        <div class="col-3">
                          <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="text" class="form-control" name="pnum" id="phone" placeholder="Phone Number" />
                          </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                              <label for="email">Company Email</label>
                              <input type="email" class="form-control" name="email" id="email" value="<?php echo $randomEmail?>" readonly />
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                              <label for="department">Department</label>
                              <select class="form-select" name="department" id="deparment">
                                <option selected disabled style="text-align: center;">Deparment</option>
                                <option value="service" style="text-align: center;">Service</option>
                                <option value="factory" style="text-align: center;">Factory</option>
                                <option value="item 3" style="text-align: center;">item 3</option>
                              </select>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="form-group">
                              <label for="role" >Role</label>
                              <select class="form-select" name="role" id="role">
                                <option selected disabled style="text-align: center;">Role</option>
                                <option value="supervisor" style="text-align: center;">Supervisor</option>
                                <option value="item 2" style="text-align: center;">item 2</option>
                                <option value="item 3" style="text-align: center;">item 3</option>
                              </select>
                            </div>
                        </div>
                      </div>

                      <div class="row justify-content-center mt-4">
                      <div class="col-2">
                        <div class="form-group">
                          <label for="citizenId">Citizen ID</label>
                          <input type="text" class="form-control" name="citizen" id="citizenId" placeholder="Citizen ID" />
                        </div>
                      </div>
                      <div class="col-2">
                          <div class="form-group">
                            <label for="salary">Salary</label>
                            <input type="text" class="form-control" name="salary" id="salary" placeholder="e.g. RM1000" />
                          </div>
                      </div>
                      <div class="col-3">
                        <div class="form-group">
                          <label for="picture">Picture (.jpg)</label>
                          <input type="file" class="form-control" name="picture" id="picture" accept=".jpg" />
                        </div>
                      </div>
                      </div>

                      <div class="row justify-content-center mt-4">
                        <div class="col-10">
                          <div class="form-group">
                            <label for="address1">Address Line 1</label>
                            <input type="text" class="form-control" name="address1" id="address1" placeholder="Address Line 1" />
                          </div>
                        </div>
                      </div>

                      <div class="row justify-content-center mt-3">
                      <div class="col-10">
                        <div class="form-group">
                          <input type="text" class="form-control" name="address2" id="address2" placeholder="Address Line 2 (Optional)" />
                        </div>
                      </div>
                      </div>

                      <div class="row justify-content-center mt-3">
                      <div class="col-3">
                        <div class="form-group">
                          <label for="postcode">Postcode</label>
                          <input type="text" class="form-control" name="postcode" id="postcode" placeholder="Postcode" />
                        </div>
                      </div>
                      <div class="col-3">
                          <div class="form-group">
                            <label for="state">State</label>
                            <input type="text" class="form-control" name="state" id="state" placeholder="State" />
                          </div>
                      </div>
                      <div class="col-3">
                        <div class="form-group">
                          <label for="country">Country</label>
                          <input type="text" class="form-control" name="country" id="country" placeholder="Country" />
                        </div>
                      </div>
                  </div>


                  <div class="row justify-content-center mt-3">
                    <button class="btn btn-primary" id="add">Add</button>
                  </div>

                  </form>

                    
                </div>
            </div>
  

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
    <script src="../asset/sidebar.js"></script>
</body>

</html>