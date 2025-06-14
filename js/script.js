window.addEventListener("DOMContentLoaded", () => {
 

  let currentMonth = 5; // June (0-based)
  let currentYear = 2025;

  let staffid = document.getElementById("staffid").value;
  console.log("staffid", staffid);
  const month = document.getElementById("monthLabel");
  console.log("Month", month.textContent);
  const page = document.getElementById("page").value;
  console.log("Page", page);

  let x = "bruh";

  function updateMonth() {
    const labelDate = new Date(currentYear, currentMonth);
    const label = labelDate.toLocaleString("default", {
      month: "long",
      year: "numeric",
    });
    document.getElementById("monthLabel").innerText = label;

    const formattedDate = `${labelDate.getFullYear()}-${String(
      labelDate.getMonth() + 1
    ).padStart(2, "0")}`;
    document.getElementById("monthLabel").dataset.isoDate = formattedDate; // Add data attribute
    console.log("ISO Date:", formattedDate); // eg: ISO Date: 2025-06

    if(page === "staff"){

      fetchStaffData(staffid, formattedDate);
    }else {
      fetchStaffPayroll(staffid, formattedDate);
    }
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

  updateMonth();

  function fetchStaffData(staffID, formattedDate) {
    fetch("../dashboard/php/fetch.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: `staffID=${encodeURIComponent(staffID)}&payDate=${encodeURIComponent(formattedDate)}&page=${encodeURIComponent(page)}`,
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.error) {
          console.error("Error:", data.error);
        document.getElementById("payslipContainer").innerHTML = `
          <div class="alert alert-warning text-center">
            No record found for this month.
          </div>`;
        } else {
          console.log("Staff Data:", data);
          const netSalary = parseFloat(data.netsalary) || 0;
          const bonus = parseFloat(data.bonus) || 0;
          const deduction = parseFloat(data.deduction) || 0;

          const totalPayment = (netSalary + bonus - deduction).toFixed(2);

         
             document.getElementById("payslipContainer").innerHTML = `
            <div class="card shadow">
              <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Payroll Slip</h5>
              </div>
              <div class="card-body">
                <table class="table table-borderless">
                  <tr><th>Staff ID:</th><td>${data.staffFullName}</td></tr>
                  <tr><th>Deparment:</th><td>${data.staffDepartment}</td></tr>
                  <tr><th>Net Salary:</th><td>RM${netSalary}</td></tr>
                  <tr><th>Bonus:</th><td>RM${bonus}</td></tr>
                  <tr><th>Deduction:</th><td>RM${deduction}</td></tr>
                  <tr class="table-primary">
                    <th>Total Payment:</th><td>RM${totalPayment}</td>
                  </tr>
                </table>
              </div>
            </div>`;
          
        }
      })
      .catch((error) => console.error("Fetch error:", error));
  }

function fetchStaffPayroll(staffid, formattedDate) {
  fetch("../dashboard/php/fetch.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
    body: `staffID=${encodeURIComponent(staffid)}&payDate=${encodeURIComponent(formattedDate)}&page=payroll`,
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.error) {
        console.error("Error:", data.error);
      } else if (data.length === 0) {
        document.getElementById("payslipContainer").innerHTML = `
          <div class="alert alert-warning text-center">
            No Payroll found for this month.
          </div>`;
      } else {
        let rowsHTML = "";

        data.forEach((staff) => {
          rowsHTML += `
            <tr class="text-center">
              <input type="hidden" name="payrollID[]" value="${staff.payrollID}">
              <td><a href="admin_sidebar.php?page=view_staff">${staff.staffID}</a></td>
              <td>${staff.staffFullName}</td>
              <td>${staff.netsalary}</td>
              <td>RM <input type="text" value="${staff.bonus}" name="bonus[${staff.payrollID}]"></td>
              <td>RM <input type="text" value="${staff.deduction}" name="deduction[${staff.payrollID}]"></td>
              
            </tr>`;
        });

        document.getElementById("payslipContainer").innerHTML = `
          <div class="container bg-white p-4 rounded shadow-sm">
            <form action="../functions/update.php" method="POST">
              <input type="hidden" name="type" value="payroll">
              <h3 class="mb-4 text-center">All Staff Payroll</h3>
              <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle text-center">
                  <thead class="table-dark text-center">
                    <tr>
                      <th>Staff ID</th>
                      <th>Name</th>
                      <th>NetSalary</th>
                      <th>Bonus</th>
                      <th>Deduction</th>
                    </tr>
                  </thead>
                  <tbody id="requestTable">
                    ${rowsHTML}
                  </tbody>
                </table>
              </div>
                 <div class="text-center my-3">
                 <button type="submit" class="btn btn-primary">Update</button>
              </div>
            </form>
          </div>`;
      }
    })
    .catch((error) => console.error("Fetch error:", error));
}



});

function printToPDF() {
const printContents = document.getElementById("payslipContainer").innerHTML;
const originalContents = document.body.innerHTML;

document.body.innerHTML = printContents;
window.print();
document.body.innerHTML = originalContents;

// Restore original scripts/styles if needed
location.reload(); // optional: reloads to re-bind JS events
}


  