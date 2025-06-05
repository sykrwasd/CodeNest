<?php 
print_r($_SESSION);

?>

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
    <div class="container mt-5">
        <h2 class="mb-4">Dashboard</h2>
        
        <div class="row">
            <!-- Bar Chart -->
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header">Bar Chart</div>
                    <div class="card-body">
                        <canvas id="barChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Line Chart -->
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header">Line Chart</div>
                    <div class="card-body">
                        <canvas id="lineChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Pie Chart -->
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header">Pie Chart</div>
                    <div class="card-body">
                        <canvas id="pieChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Bar Chart
        new Chart(document.getElementById('barChart'), {
            type: 'bar',
            data: {
                labels: ['Red', 'Blue', 'Yellow', 'Green'],
                datasets: [{
                    label: 'Bar Data',
                    data: [12, 19, 3, 5],
                    backgroundColor: ['red', 'blue', 'yellow', 'green']
                }]
            },
            options: { responsive: true }
        });

        // Line Chart
        new Chart(document.getElementById('lineChart'), {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr'],
                datasets: [{
                    label: 'Line Data',
                    data: [3, 10, 5, 8],
                    fill: false,
                    borderColor: 'blue',
                    tension: 0.1
                }]
            },
            options: { responsive: true }
        });

        // Pie Chart
        new Chart(document.getElementById('pieChart'), {
            type: 'pie',
            data: {
                labels: ['Apple', 'Samsung', 'Huawei'],
                datasets: [{
                    label: 'Pie Data',
                    data: [40, 30, 30],
                    backgroundColor: ['red', 'purple', 'orange']
                }]
            },
            options: { responsive: true }
        });
    </script>
</body>
</html>
