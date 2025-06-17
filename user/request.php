<?php
include('../config/database.php');

$staffID = $_SESSION['staffID'];

// print_r($_SESSION);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {


  $requestID = rand(100000, 999999); // updateID
  $content = $_POST['content'];
  // echo $adminID;
  //echo nl2br($content);

  echo $requestID, $content, 'Unread', $staffID;


  $insertRequest = "INSERT INTO request_updates (
            requestID,inbox,status,staffID
          ) VALUES (?, ?, 'Unread', ?)";

  $stmt = $conn->prepare($insertRequest);
  $stmt->bind_param("isi", $requestID, $content, $staffID);
  $result = $stmt->execute();

  if ($result) {
    echo "<html>
    <head>
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <link rel='stylesheet' href='../css/view_staff.css'>
    </head>
    <body>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Added',
                text: 'Request successfully Added',
                confirmButtonText: 'Back'
            }).then(() => {
                window.history.back();
            });
        </script>
    </body>
    </html>";
  } else {
    echo "<script>alert('Database Error: " . mysqli_error($conn) . "');</script>";
  }

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
    crossorigin="anonymous">
  <link rel="stylesheet" href="../css/view_staff.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
  <div class="container p-4 border rounded shadow-sm bg-white" style="max-width: 800px;">
    <h4 class="text-center mb-4">Application Form to the Administration</h4>

    <form action="" method="POST">

      <div class="container">
        <div class="row">
          <div class="col">
            <div class="mb-3">
              <?php
              $viewQuery = $conn->prepare('SELECT * FROM staff WHERE staffID = ?');
              $viewQuery->bind_param('s', $staffID);
              $viewQuery->execute();
              $result = $viewQuery->get_result();

              while ($row = $result->fetch_assoc()) {
                ?>
                <label for="requestTitle" class="form-label fw-semibold">From</label>
                <input label="ad" type="text" class="form-control"
                  value="<?php echo htmlspecialchars($row['staffFullName']); ?>" readonly>
              <?php } ?>
            </div>
          </div>

        </div>
      </div>

      <div>
        <label class="form-label fw-semibold">Official Letter</label>
        <textarea name="content" class="form-control" rows="12" required><?php echo
          "Application Title: [State your title here]\n\n" .
          "Date: " . date("d/m/Y") . "\n\n" .
          "To,\nAdministration,\n\nSir/Madam,\n\nRE: [State the purpose of your request here]\n\nRespectfully, the above matter is referred to.\n\nI, [Full Name], would like to apply for [purpose of request] for the following reasons:\n\n1. [First reason]\n2. [Second reason, if any]\n\nI hope this application will be given due consideration. Your cooperation is highly appreciated.\n\nThank you.\n\nYours sincerely,\n[Full Name]\n[Position / Staff ID]";
        ?></textarea>
        <div class="form-text">Please edit the official letter content as needed.</div>
      </div>

      <div class="text-end">
        <button type="submit" class="btn btn-success">Submit Application</button>
      </div>
    </form>
  </div>

  <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Staff Details</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="modalBody">
          <table class="table table-bordered table-hover staff-table">
            <thead class="table-primary text-center">
              <tr>
                <th scope="col"><i class="fa-solid fa-image"></i> Request ID</th>
                <th scope="col"><i class="fa-solid fa-location-dot"></i> Status</th>

              </tr>
            </thead>
            <tbody>
              <?php
              $viewQuery = $conn->prepare('SELECT * from request_updates ');
              $viewQuery->execute();
              $result = $viewQuery->get_result();
              while ($row = $result->fetch_assoc()) {
                ?>
                <tr>

                  <td><?php echo $row['requestID']; ?></td>
                  <td> <span
                      class="badge <?php echo $row['status'] == 'Read' ? 'bg-success' : 'bg-warning text-dark'; ?>">
                      <?php echo $row['status']; ?>
                    </span></td>

                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <div class="text-center my-3">
    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
      <i class="fa-solid fa-eye"></i> View Status
    </button>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    crossorigin="anonymous"></script>
</body>

</html>