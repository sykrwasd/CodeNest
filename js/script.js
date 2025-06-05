let currentMonth = 5; // June (0-based)
let currentYear = 2025;

function updateMonth() {
  const monthLabel = new Date(currentYear, currentMonth).toLocaleString('default', { month: 'long', year: 'numeric' });
  document.getElementById("monthLabel").innerText = monthLabel;
  updatePayroll(monthLabel); // Update slip gaji view
}

document.getElementById("prevMonth").addEventListener("click", () => {
  currentMonth--;
  if (currentMonth < 0) {
    currentMonth = 11;
    currentYear--;
  }
  updateMonth();
});

document.getElementById("nextMonth").addEventListener("click", () => {
  currentMonth++;
  if (currentMonth > 11) {
    currentMonth = 0;
    currentYear++;
  }
  updateMonth();
});

// Initial load
updateMonth();

function updatePayroll(monthLabel) {
  // Dummy data — replace with dynamic data if needed
  const name = "Umar Syakir";
  const position = "Software Developer";
  const basic = 3500;
  const allowance = 300;
  const deduction = 250;
  const net = basic + allowance - deduction;

  document.getElementById("payslipContainer").innerHTML = `
    <div class="card shadow">
      <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Slip Gaji - ${monthLabel}</h5>
      </div>
      <div class="card-body">
        <table class="table table-borderless">
          <tr><th>Nama Pekerja:</th><td>${name}</td></tr>
          <tr><th>Jawatan:</th><td>${position}</td></tr>
          <tr><th>Gaji Pokok:</th><td>RM ${basic.toFixed(2)}</td></tr>
          <tr><th>Elaun:</th><td>RM ${allowance.toFixed(2)}</td></tr>
          <tr><th>Potongan:</th><td>RM ${deduction.toFixed(2)}</td></tr>
          <tr class="table-primary">
            <th>Gaji Bersih:</th><td>RM ${net.toFixed(2)}</td>
          </tr>
        </table>
      </div>
     
    </div>
  `;
}


function printToPDF() {
  // Hide the modal (if using Bootstrap modal)
 
  setTimeout(function () {
    const payslipContainer = document.getElementById('payslipContainer');
    if (!payslipContainer) return;

    const printContents = payslipContainer.innerHTML;
    const originalContents = document.body.innerHTML;

    document.body.style.background = 'white';
    document.body.style.color = 'black';

    document.body.innerHTML = printContents;

    window.print();
    
    // Optional: Reload to restore dynamic content
    window.location.reload();
  }, 100); // slight delay for modal close animation
}
