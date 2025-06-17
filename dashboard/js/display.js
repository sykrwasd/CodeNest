//fecth semua benda
fetch('../dashboard/php/fetch.php') //hantar fetch.php
    .then(response => response.json()) // tunggu response php
    .then(data => {
        document.getElementById('totalStaff').textContent = data.total_staff;
        document.getElementById('totalRequest').textContent = data.total_request;
        document.getElementById('totalEvaluation').textContent = data.total_eval;
        createStatusPieChart(data);
        createDepartmentBarChart(data);
        createPayrollLineChart(data);
        createMultiAxisChart(data);
    })
    .catch(error => {
        console.error("Error fetching chart data:", error);
    });

// pie chart function
function createDepartmentBarChart(data) {
    const ctx = document.getElementById('barChart');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Sales', 'Accounting', 'Marketing'],
            datasets: [{
                label: 'Number of Staff',
                data: [data.sales, data.accounting, data.marketing],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.5)',
                    'rgba(54, 162, 235, 0.5)',
                    'rgba(255, 206, 86, 0.5)'
                ],
               
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

function createStatusPieChart(data) {
    const ctx = document.getElementById('pieChart');
    console.log("data",data)

    new Chart(ctx, {
    type: 'pie',
    data: {
      labels: ['Read', 'Unread'],
      datasets: [{
        label: 'Status ',
        data: [data.total_read, data.total_unread],
       backgroundColor: [
                    'rgb(149, 248, 74)',
                    'rgb(255, 66, 66)',
                ],
               
        
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
        text: 'Request Read Status Distribution',
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

function createPayrollLineChart(data){
     const ctx = document.getElementById('lineChart');
    console.log("data",data)

    const months = data.monthly_payroll.map(item => item.month);
  const payrolls = data.monthly_payroll.map(item => parseFloat(item.total_payroll));


   new Chart(ctx, {
    type: 'line',
    data: {
        labels: months,
        datasets: [{
            label: 'Monthly Payroll Overview',
            data: payrolls,
            fill: false,
            borderColor: 'rgb(109, 197, 252)',
            tension: 0.3
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { display: true },
            title: {
                display: true,
                text: 'Monthly Payroll',
                font: {
                        size: 18,
                        weight: 'bold'
                    },
                
            }
        }
    }
});
}

function createMultiAxisChart(data){
    const ctx = document.getElementById('multiAxisChart');
    console.log("data", data);

    const months = data.monthly_payroll.map(item => item.month);
    const bonus = data.monthly_payroll.map(item => parseFloat(item.total_bonus));
    const deduction = data.monthly_payroll.map(item => parseFloat(item.total_deduction));

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: months,
            datasets: [
                {
                    label: 'Total Bonus',
                    data: bonus,
                    yAxisID: 'y1',
                    borderColor: 'rgb(44, 255, 7)',
                    tension: 0.3,
                    fill: false
                },
                {
                    label: 'Total Deduction',
                    data: deduction,
                    yAxisID: 'y1',
                    borderColor: 'rgb(216, 0, 0)',
                    tension: 0.3,
                    fill: false
                }
            ]
        },
        options: {
            responsive: true,
            interaction: {
                mode: 'index',
                intersect: false,
            },
            stacked: false,
            plugins: {
                title: {
                    display: true,
                    text: 'Monthly Bonus vs Deduction',
                    font: {
                        size: 18,
                        weight: 'bold'
                    },
                }
            },
            scales: {
                y: {
                    type: 'linear',
                    display: true,
                    
                },
                y1: {
                    type: 'linear',
                    display: true,
                    position: 'right',
                    grid: {
                        drawOnChartArea: false
                    },
                    title: {
                        display: true,
                        text: 'Bonus & Deduction'
                    }
                }
            }
        }
    });

}