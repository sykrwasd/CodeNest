<?php

$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard'; //set default page to dashboard if not set
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Human Resource Admin</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/sidebar.css">
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
                    <a href="?page=staff_add" class="sidebar-link">
                        <i class="lni lni-agenda"></i>
                        <span>Add Employee</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="?page=view_staff" class="sidebar-link">
                        <i class="lni lni-popup"></i>
                        <span>View Employee</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="?page=view_payroll" class="sidebar-link">
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
            <div class="sidebar-footer text-center p-3">
                <form action="logout.php">
                    <button type="submit" class="btn btn-outline-danger d-flex align-items-center gap-2">
                        <i class="lni lni-exit"></i>
                        <span>  </span>
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