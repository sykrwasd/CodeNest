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
    <div class="content container-fluid p-3">

        <div class="row">

            <div class="col-md-3">
                <div class="card shadow rounded-4 border-0" style="background-color: #ffd463">
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
                <div class="card shadow rounded-4 border-0" style="background-color: #ffd463">
                    <div class="card-body">
                        <h6 class="card-title">Total Staff</h6>
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 id="totalRequest" class="mb-0 fw-bold fs-5">...</h4>
                            <i class="bi bi-people zfs-3"></i>
                        </div>
                        <p class="small text-muted mb-0">Total Request</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow rounded-4 border-0" style="background-color: #ffd463">
                    <div class="card-body">
                        <h6 class="card-title">Total Staff</h6>
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 id="totalEvaluation" class="mb-0 fw-bold fs-5">...</h4>
                            <i class="bi bi-people zfs-3"></i>
                        </div>
                        <p class="small text-muted mb-0">Total Evaluation</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow rounded-4 border-0" style="background-color: #ffd463">
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
    <div class="row mt-4 g-0">

        <div class="col-md-6 d-flex justify-content-center p-0 m-0">
            <canvas id="pieChart" width="400" height="400"></canvas>
        </div>
        <div class="col-md-6 d-flex justify-content-center p-0 m-0">
            <canvas id="doughnutChart" width="400" height="400"></canvas>
        </div>
    </div>

</body>
<script src="../dashboard/js/display.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</html>