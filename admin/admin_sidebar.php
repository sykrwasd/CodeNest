<?php
session_start();
$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard'; // default page
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Human Resource Admin</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        
    <link rel="stylesheet" href="../css/sidebar.css">
</head>

<body>
    <div class="wrapper">
        <aside id="sidebar">
            <div class="d-flex">
                <button class="toggle-btn" type="button">
                    <i class="fa-solid fa-bars"></i>
                </button>
                <div class="sidebar-logo">
                    <a href="#">Code<span>Nest</span></a>
                </div>
            </div>

            <ul class="sidebar-nav">
                <li class="sidebar-item">
                    <a href="?page=dashboard" class="sidebar-link">
                        <i class="fa-solid fa-chart-line"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <!-- Employee Manager -->
                <li class="sidebar-item">
                    <a class="sidebar-link" data-bs-toggle="collapse" href="#employeeManager" role="button" aria-expanded="false" aria-controls="employeeManager">
                        <i class="fa-solid fa-users"></i>
                        <span>Employee Manager</span>
                        <i class="fa-solid fa-caret-down ms-auto"></i>
                    </a>
                    <div class="collapse ps-3" id="employeeManager">
                        <ul class="sidebar-subnav">
                            <li>
                                <a href="?page=staff_add" class="sidebar-link">
                                    <i class="fa-solid fa-user-plus me-1"></i>Add Employee
                                </a>
                            </li>
                            <li>
                                <a href="?page=view_staff" class="sidebar-link">
                                    <i class="fa-solid fa-list me-1"></i>View Employee
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- Payroll Manager -->
                <li class="sidebar-item">
                    <a class="sidebar-link" data-bs-toggle="collapse" href="#payrollManager" role="button" aria-expanded="false" aria-controls="payrollManager">
                        <i class="fa-solid fa-money-check-dollar"></i>
                        <span>Payroll Manager</span>
                        <i class="fa-solid fa-caret-down ms-auto"></i>
                    </a>
                    <div class="collapse ps-3" id="payrollManager">
                        <ul class="sidebar-subnav">
                            <li>
                                <a href="?page=payroll_add" class="sidebar-link">
                                    <i class="fa-solid fa-circle-plus me-1"></i>Add Payroll
                                </a>
                            </li>
                            <li>
                                <a href="?page=view_payroll" class="sidebar-link">
                                    <i class="fa-solid fa-list me-1"></i>View Payroll
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- Payslip Manager -->
                <li class="sidebar-item">
                    <a class="sidebar-link" data-bs-toggle="collapse" href="#payslipManager" role="button" aria-expanded="false" aria-controls="payslipManager">
                        <i class="fa-solid fa-file-invoice-dollar"></i>
                        <span>Payslip Manager</span>
                        <i class="fa-solid fa-caret-down ms-auto"></i>
                    </a>
                    <div class="collapse ps-3" id="payslipManager">
                        <ul class="sidebar-subnav">
                            <li>
                                <a href="?page=view_payslip" class="sidebar-link">
                                    <i class="fa-solid fa-eye me-1"></i>View Payslip
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

               
                <li class="sidebar-item">
                    <a class="sidebar-link collapsed" data-bs-toggle="collapse" href="#evaluationMenu" role="button" aria-expanded="false" aria-controls="evaluationMenu">
                        <i class="fa-solid fa-star-half-stroke"></i>
                        <span>Evaluation</span>
                        <i class="fa-solid fa-caret-down ms-auto"></i>
                    </a>
                    <div class="collapse ps-4" id="evaluationMenu">
                        <ul class="list-unstyled">
                            <li>
                                <a href="?page=admin_evaluate" class="sidebar-link">
                                    <i class="fa-solid fa-square-plus me-1"></i>Add Evaluation
                                </a>
                            </li>
                            <li>
                                <a href="?page=view_evaluate" class="sidebar-link">
                                    <i class="fa-solid fa-list-check me-1"></i>View Evaluation
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>



                <!-- View Requests -->
                <li class="sidebar-item">
                    <a href="?page=view_request" class="sidebar-link">
                        <i class="fa-solid fa-inbox"></i>
                        <span>View Requests</span>
                    </a>
                </li>

               

                <!-- Profile -->
                <li class="sidebar-item">
                    <a href="?page=admin_profile" class="sidebar-link">
                        <i class="fa-solid fa-user-gear"></i>
                        <span>Profile</span>
                    </a>
                </li>
            </ul>

            <!-- Logout -->
            <div class="sidebar-footer text-center p-3">
                <form action="../logout.php">
                    <button type="submit" class="btn btn-danger d-flex align-items-center gap-2">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </aside>

        <div class="main p-3">
            <?php
                $filepath = "$page.php";
                if (file_exists($filepath)) {
                    include $filepath;
                } else {
                    echo "<h2>Page not found.</h2>";
                }
            ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
    <script src="../asset/sidebar.js"></script>
</body>

</html>
