<?php 
include('../config/database.php');

$emailID = $_SESSION['userID'];

$viewQuery = $conn->prepare('SELECT * FROM staff WHERE staffID = ?');
$viewQuery->bind_param('s', $emailID); 
$viewQuery->execute();
$result = $viewQuery->get_result();

while ($row = $result->fetch_assoc()) {
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
<link rel="stylesheet" href="../css/view_staff.css">

<div class="container mt-1">
    <!-- Quick Actions Section -->
    <div class="card mb-1">
        <div class="card-header bg-white">
            <h5 class="mb-0">Quick Actions</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <a href="?page=request" class="btn btn-outline-primary w-100">
                        <i class="fas fa-calendar-plus"></i>
                        Apply Leave
                    </a>
                </div>
                <div class="col-md-4 mb-3">
                    <a href="?page=view_payslip" class="btn btn-outline-success w-100">
                        <i class="fas fa-file-invoice-dollar"></i>
                        View Payslip
                    </a>
                </div>
                <div class="col-md-4 mb-3">
                    <a href="?page=user_evaluate" class="btn btn-outline-info w-100">
                        <i class="fas fa-star"></i>
                        Performance
                    </a>
                </div>
                
            </div>
        </div>
    </div>

    <!-- Profile Section -->
    <div class="row">
        <!-- Profile Card -->
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body text-center">
                    <div class="position-relative d-inline-block mb-3">
                        <img src="../img/<?php echo htmlspecialchars($row['staffPicture']); ?>" 
                             class="rounded-circle" 
                             width="150" 
                             height="150" 
                             alt="Staff Picture"
                             style="object-fit: cover;">
                        <span class="position-absolute bottom-0 end-0 bg-success rounded-circle p-2 border border-white"></span>
                    </div>
                    <h3 class="mb-1"><?php echo htmlspecialchars($row['staffFullName']); ?></h3>
                    <p class="text-muted mb-3"><?php echo htmlspecialchars($row['staffDepartment']); ?></p>
                    
                </div>
            </div>

            <!-- Contact Information Card -->
            <div class="card mt-2">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Contact Information</h5>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled mb-0">
                        <li class="mb-3">
                            <i class="fas fa-envelope text-primary me-2"></i>
                            <?php echo htmlspecialchars($row['staffEmail']); ?>
                        </li>
                        <li class="mb-3">
                            <i class="fas fa-phone text-primary me-2"></i>
                            <?php echo htmlspecialchars($row['staffNoPhone']); ?>
                        </li>
                        <li>
                            <i class="fas fa-map-marker-alt text-primary me-2"></i>
                            <?php echo htmlspecialchars($row['staffAddress']); ?>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Personal Information Card -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Personal Information</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label class="form-label text-muted">Staff ID</label>
                            <p class="mb-0 fw-bold"><?php echo htmlspecialchars($row['staffID']); ?></p>
                        </div>
                        <div class="col-md-6 mb-4">
                            <label class="form-label text-muted">Date of Birth</label>
                            <p class="mb-0 fw-bold"><?php echo htmlspecialchars($row['staffDOB']); ?></p>
                        </div>
                        <div class="col-md-6 mb-4">
                            <label class="form-label text-muted">IC Number</label>
                            <p class="mb-0 fw-bold"><?php echo htmlspecialchars($row['staffIC']); ?></p>
                        </div>
                        <div class="col-md-6 mb-4">
                            <label class="form-label text-muted">Hire Date</label>
                            <p class="mb-0 fw-bold"><?php echo htmlspecialchars($row['staffHireDate']); ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Analytics Section -->
            <div class="card mt-2">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Work Analytics</h5>
                </div>
                <div class="card-body">
                    <!-- Statistics Cards -->
                    <div class="row mb-4">
                        <div class="col-md-3 mb-3">
                            <div class="card bg-primary text-white">
                                <div class="card-body">
                                    <h6 class="card-title">Pending Request</h6>
                                    <h3 class="mb-0"></h3>
                                    <small>Number of Pending Request</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card bg-success text-white">
                                <div class="card-body">
                                    <h6 class="card-title">Approved Request</h6>
                                    <h3 class="mb-0"></h3>
                                    <small>Number of Approved Request</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card bg-info text-white">
                                <div class="card-body">
                                    <h6 class="card-title">Attendance</h6>
                                    <h3 class="mb-0">95%</h3>
                                    <small>This Month</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card bg-warning text-white">
                                <div class="card-body">
                                    <h6 class="card-title">Projects</h6>
                                    <h3 class="mb-0">3</h3>
                                    <small>Active</small>
                                </div>
                            </div>
                        </div>
                    </div>

<?php } ?>
