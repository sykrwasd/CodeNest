<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar With Bootstrap</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/sidebar.css">
    <link rel="stylesheet" href="../css/staff_add.css">
    
</head>

<body>
    <div class="wrapper">
        <aside id="sidebar">
            <div class="d-flex">
                <button class="toggle-btn" type="button">
                    <i class="lni lni-grid-alt"></i>
                </button>
                <div class="sidebar-logo">
                    <a href="#">Code<span>Nest</span></a>
                </div>
            </div>
            <ul class="sidebar-nav">
                <li class="sidebar-item">
                    <a href="?page=dashboard" class="sidebar-link">
                        <i class="lni lni-user"></i>
                        <span>DashBoard</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class="lni lni-agenda"></i>
                        <span>Add Employee</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class="lni lni-popup"></i>
                        <span>View Employee</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class="lni lni-cog"></i>
                        <span>Payroll Manager</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class="lni lni-cog"></i>
                        <span>Performance Review</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class="lni lni-cog"></i>
                        <span>Setting</span>
                    </a>
                </li>
            </ul>
            <div class="sidebar-footer">
                <a href="#" class="sidebar-link">
                    <i class="lni lni-exit"></i>
                    <span>Logout</span>
                </a>
            </div>
        </aside>
            <div class="main p-3 ">
              <h2 style="text-align: center; margin-top: 0px;"> Staff Registration</h2>
                <div class="container">
                
                  <form method="post" action="add_emp.html">

                      <div class="row justify-content-center">
                        <div class="col-3">
                          <div class="form-group">
                            <label for="firstName">First Name</label>
                            <input type="text" class="form-control" name="firstName" id="firstName" placeholder="First Name" />
                          </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                              <label for="lastName">Last Name</label>
                              <input type="text" class="form-control" name="lastName" id="lastName" placeholder="Last Name" />
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
                            <input type="text" class="form-control" name="phone" id="phone" placeholder="Phone Number" />
                          </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                              <label for="email">Company Email</label>
                              <input type="email" class="form-control" name="email" id="email" placeholder="companyemail@gmail.com" />
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                              <label for="position">Position</label>
                              <select class="form-select" name="position" id="position">
                                <option selected>Position</option>
                                <option value="item 1">item 1</option>
                                <option value="item 2">item 2</option>
                                <option value="item 3">item 3</option>
                                <option value="...">more items..</option>
                              </select>
                            </div>
                        </div>
                      </div>

                      <div class="row justify-content-center mt-4">
                      <div class="col-2">
                        <div class="form-group">
                          <label for="citizenId">Citizen ID</label>
                          <input type="text" class="form-control" name="citizenId" id="citizenId" placeholder="Citizen ID" />
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
                    <button class="btn btn-primary">Add</button>
                  </div>

                  </form>

                    
                </div>
            </div>
        </div>
    </div>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
    <script src="../asset/sidebar.js"></script>
</body>

</html>