<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard with Charts</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="../css/view_staff.css">
</head>

<body>
    <div class="content container-fluid ">

        <div class="card mt-1">
            <div class="card-header bg-white">
                    <h5 class="mb-0">Hello, Administrator</h5>
                </div>
            <div class="row mb-4 px-1">
    
                <div class="col-md-3">
                    <div class="card shadow rounded-4 border-0 mt-4" style="background-color:rgb(246, 221, 156)">
                        <div class="card-body">
                            <h6 class="card-title">Total Staff</h6>
                            <div class="d-flex justify-content-between align-items-center">
                                <h4 id="totalStaff" class="mb-0 fw-bold fs-5">...</h4>
                                <i class="bi bi-people zfs-3"></i>
                            </div>
                            <p class="small text-muted mb-0">Number of staff</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card shadow rounded-4 border-0 mt-4" style="background-color:rgb(133, 198, 255)">
                        <div class="card-body">
                            <h6 class="card-title">Total Request</h6>
                            <div class="d-flex justify-content-between align-items-center">
                                <h4 id="totalRequest" class="mb-0 fw-bold fs-5">...</h4>
                                <i class="bi bi-people zfs-3"></i>
                            </div>
                            <p class="small text-muted mb-0">Number of Request</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card shadow rounded-4 border-0 mt-4" style="background-color:rgb(200, 255, 160)">
                        <div class="card-body">
                            <h6 class="card-title">Total Evaluation</h6>
                            <div class="d-flex justify-content-between align-items-center">
                                <h4 id="totalEvaluation" class="mb-0 fw-bold fs-5">...</h4>
                                <i class="bi bi-people zfs-3"></i>
                            </div>
                            <p class="small text-muted mb-0">Number of Evaluation</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card shadow rounded-4 border-0 mt-4" style="background-color:rgb(244, 189, 126)">
                        <div class="card-body">
                            <h6 class="card-title">Total Staff</h6>
                            <div class="d-flex justify-content-between align-items-center">
                                <h4 id="totalStaff" class="mb-0 fw-bold fs-5">...</h4>
                                <i class="bi bi-people zfs-3"></i>
                            </div>
                            <p class="small text-muted mb-0">Number of staff</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mt-2">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Work Analytics</h5>
                </div>
               


                    <div class="row mt-4 g-0 mb-4">
                
                        <div class="col-md-4 d-flex justify-content-center p-0 m-0">
                            <canvas id="pieChart" width="250" height="250"></canvas>
                        </div>
                        <div class="col-md-4 d-flex justify-content-center p-0 m-0">
                            <canvas id="doughnutChart" width="250" height="250"></canvas>
                        </div>
                    </div>
    </div>

</body>
<script src="../dashboard/js/display.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</html>