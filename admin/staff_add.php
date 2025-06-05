  <?php
  include '../config/database.php';
  $staffID = 2025 . rand(100000,999999); // staffID
  $salaryID = rand(100000,999999); // staffID
  $randomEmail = $staffID . '@nazacorp.com';
  $payrollID = rand(100000,999999); // payrollID
  $performanceID = rand(100000,999999); // performanceID
  $updateID = rand(100000,999999); // updateID
  $departmentID = rand(100000,999999); // departmentID




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

          // Insert into new schema
          $insertStaff = "INSERT INTO staff (
            staffEmail, staffID, staffFullName, staffNoPhone, staffAddress, 
            staffDOB, staffIC, staffHireDate, staffDepartment, staffPicture
          ) VALUES (
            '$email', '$staffID', '$fullname', '$pnum', '$fulladdress',
            '$dob', '$staffIC', '$hireDate', '$department', '$imageName'
          )";
          

          $insertSalary = "INSERT INTO salary (
            salaryID, basicSalary,	allowance,	staffID
          ) VALUES (
            '$salaryID', '$salary', '100', '$staffID'
          )";

          $insertUser = "INSERT INTO user (
            userEmail, userPassword,	category
          ) VALUES (
            '$email','newuser','staff'
          )";

            $insertPayroll = "INSERT INTO payroll (
              payrollID, salaryID, payDate, bonus, deduction, netsalary, staffID
            ) VALUES (
              '$payrollID', '$salaryID', '0', '0', '0', '0', '$staffID'
            )";

          $insertPerformance = "INSERT INTO performance (
            performID, staffID, evaluatorName, evaluateDate, remarks, status
          ) VALUES (
            '$performanceID', '$staffID', '0', '0', '0', '0'
          )";


            $insertUpdate = "INSERT INTO request_update (
              updateID, inbox, status, staffID, adminID
            ) VALUES (
              '$updateID', '0', '0', '$staffID', '0'
            )";
            
            $insertDepartment = "INSERT INTO department (
              departmentID,departmentType, role, place
            ) VALUES (
              '$departmentID','$department', '$role', 'idk'
            )";
            
            
            

          $staffResult = mysqli_query($conn, $insertStaff);
          $salaryResult = mysqli_query($conn, $insertSalary);
          $userResult = mysqli_query($conn, $insertUser);
          $payrollResult = mysqli_query($conn, $insertPayroll);
          $performanceResult = mysqli_query($conn, $insertPerformance);
          $updateResult = mysqli_query($conn, $insertUpdate);
          $departmentResult = mysqli_query($conn, $insertDepartment);

          

          if ($staffResult && $salaryResult && $userResult && $payrollResult && $performanceResult && $updateResult && $departmentResult) {
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
      <title>Add Staff</title>
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
                          <div class="col-2">
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
                                  <option value="Service" style="text-align: center;">Sales</option>
                                  <option value="Factory" style="text-align: center;">Accounting</option>
                                  <option value="Marketing" style="text-align: center;">Marketing</option>
                                </select>
                              </div>
                          </div>
                          <div class="col-3">
                              <div class="form-group">
                                <label for="role" >Role</label>
                                <select class="form-select" name="role" id="role">
                                      <option selected disabled style="text-align: center;">Role</option>

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
                          </div>
                        </div>

                        <div class="row justify-content-center mt-4">
                        <div class="col-2">
                          <div class="form-group">
                            <label for="citizenId">Staff IC</label>
                            <input type="text" class="form-control" name="staffIC" id="staffIC" placeholder="Staff IC" />
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