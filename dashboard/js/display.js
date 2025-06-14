//fecth semua benda
fetch('../dashboard/php/fetch.php')
    .then(response => response.json())
    .then(data => {
        document.getElementById('totalStaff').textContent = data.total_staff;
        document.getElementById('totalRequest').textContent = data.total_request;
        document.getElementById('totalEvaluation').textContent = data.total_eval;
        createStatusDoughnutChart(data);
        createDepartmentPieChart(data);
    })
    .catch(error => {
        console.error("Error fetching chart data:", error);
    });

// pie chart function
function createDepartmentPieChart(data) {
    const ctx = document.getElementById('pieChart');

    new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Service', 'Accounting', 'Marketing'],
            datasets: [{
                label: 'Number of Staff',
                data: [data.service, data.accounting, data.marketing],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.5)',
                    'rgba(54, 162, 235, 0.5)',
                    'rgba(255, 206, 86, 0.5)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                title: {
                    display: true,
                    text: 'Staff Distribution by Department',
                    font: {
                        size: 18,
                        weight: 'bold'
                    },
                    padding: {
                        top: 10,
                        bottom: 30
                    }
                }
            }
        }
    });
   }

function createStatusDoughnutChart(data) {
    const ctx = document.getElementById('doughnutChart');
    console.log("data",data)

    new Chart(ctx, {
    type: 'doughnut',
    data: {
      labels: ['Read', 'Unread'],
      datasets: [{
        label: 'Status ',
        data: [data.total_read, data.total_unread],
        backgroundColor: ['#3fff00 ', '#ff4000'],
        borderColor: [
                    'rgb(51, 182, 7)',
                    'rgb(189, 6, 6)',
                ],
        borderWidth: 1
      }]
    },
    options: {
      responsive: false,
      plugins: {
        legend: {
          position: 'top'
        },
        title: {
        display: true,
        text: 'Status Distribution',
        font: {
                        size: 18,
                        weight: 'bold'
                    },
                    padding: {
                        top: 10,
                        bottom: 30
                    }
      }
      }
    }
  });
}