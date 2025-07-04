<?php
session_start();
$page = isset($_GET['page']) ? $_GET['page'] : 'user_dashboard'; // set default page to dashboard if not set
if($_SESSION['category'] != 'staff'){
    echo '<script>
        alert("Access denied. Staff only.");
        window.location.href = "../login.php";
    </script>';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Naza Corp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/sidebar.css">
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <div class="wrapper">
        <aside id="sidebar">
            <div class="d-flex">
                <button class="toggle-btn" type="button">
                    <i class="lni lni-grid-alt"></i>
                </button>
                <div class="sidebar-logo">
                    <a href="#">Naza<span>Corp</span></a>
                </div>
            </div>
            <ul class="sidebar-nav">
                <li class="sidebar-item">
                    <a href="?page=user_dashboard" class="sidebar-link">
                        <i class="lni lni-dashboard"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="?page=view_payroll" class="sidebar-link">
                        <i class="lni lni-money-location"></i>
                        <span>View Payroll</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="?page=view_payslip" class="sidebar-link">
                        <i class="lni lni-user"></i>
                        <span>View Payslip</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="?page=request" class="sidebar-link">
                        <i class="lni lni-calendar"></i>
                        <span>Request</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="?page=user_evaluate" class="sidebar-link">
                        <i class="lni lni-envelope"></i>
                        <span>Evaluation</span>
                    </a>
                </li>
                  <li class="sidebar-item">
                    <a href="?page=inbox" class="sidebar-link">
                       <i class="lni lni-inbox"></i>
                        <span>Inbox</span>
                    </a>
                </li>
            </ul>
            <div class="sidebar-footer text-center p-3">
                <form action="../logout.php">
                    <button type="submit" class="btn btn-danger d-flex align-items-center justify-content-center">
                        <i class="lni lni-power-switch me-2"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </aside>
        <div class="main p-3">
            <?php
                $filepath = "$page.php";
                if (file_exists($filepath)) {
                    include($filepath);
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
