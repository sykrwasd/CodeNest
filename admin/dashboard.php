<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard with Charts</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/view_staff.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <div class="container-fluid py-4">
        <!-- Welcome -->
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-white">
                <h5 class="mb-0 fw-bold">Hello, Administrator</h5>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="row g-4 mb-4">
            <div class="col-md-3">
                <div class="card h-100 shadow-sm" style="background-color:rgb(246, 221, 156)">
                    <div class="card-body">
                        <h6>Total Staff</h6>
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 id="totalStaff" class="mb-0 fw-bold">...</h4>
                            <i class="bi bi-people fs-3"></i>
                        </div>
                        <p class="small text-muted mb-0">Number of staff</p>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card h-100 shadow-sm" style="background-color:rgb(133, 198, 255)">
                    <div class="card-body">
                        <h6>Total Request</h6>
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 id="totalRequest" class="mb-0 fw-bold">...</h4>
                            <i class="bi bi-clipboard fs-3"></i>
                        </div>
                        <p class="small text-muted mb-0">Number of requests</p>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card h-100 shadow-sm" style="background-color:rgb(200, 255, 160)">
                    <div class="card-body">
                        <h6>Total Evaluation</h6>
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 id="totalEvaluation" class="mb-0 fw-bold">...</h4>
                            <i class="bi bi-bar-chart fs-3"></i>
                        </div>
                        <p class="small text-muted mb-0">Number of evaluations</p>
                    </div>
                </div>
            </div>

            <div class="col-md-3 d-flex justify-content-center align-items-center">
                <img src="../img/logo.png" height="150" alt="Logo">
            </div>
    
        </div>

        <h2>Work Analytics</h2>
        <div class="row mb-4">
            <div class="col">
                <div class="card shadow-sm p-4">
                    <canvas id="lineChart" height="350"></canvas>
                </div>
            </div>
        </div>

        <!-- Work Analytics -->
        <div class="card shadow-sm mb-4">
            <div class="row text-center p-4">
                <div class="col-md-6 mb-3 mb-md-0">
                    <canvas id="barChart" height="350"></canvas>
                </div>
                <div class="col-md-6 d-flex justify-content-center align-items-center">
                    <canvas id="pieChart" height="350"></canvas>
                </div>
            </div>
        </div>

        <!-- Multi Axis Chart -->
        <div class="row">
            <div class="col">
                <div class="card shadow-sm p-4">
                    <canvas id="multiAxisChart" height="350"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script src="../dashboard/js/display.js"></script>
</body>

</html>