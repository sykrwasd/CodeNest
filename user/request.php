<?php
session_start();
include('../config/database.php');

$emailID = $_SESSION['userID'];

// print_r($_SESSION);


  if ($_SERVER['REQUEST_METHOD'] === 'POST') {

     $staffID = str_replace('@nazacorp.com', '', $_SESSION['userID']);

        $updateID = rand(100000,999999); // updateID

        $adminID = $_POST['adminID'];
        $content = $_POST['content'];
        // echo $adminID;
        //echo nl2br($content);



          $insertRequest = "INSERT INTO request_updates (
            updateID, inbox,status,	staffID, adminID
          ) VALUES (
            '$updateID', '$content', 'Unread', '$staffID', '$adminID'
          )";

          $result = mysqli_query($conn, $insertRequest);

          

          if ($result) {
              echo "<script>alert('Request Added Successfully');
              window.history.back();
              </script>";
          } else {
              echo "<script>alert('Database Error: " . mysqli_error($conn) . "');</script>";
          }

  }
?>


<div class="container p-4 border rounded shadow-sm bg-white" style="max-width: 800px;">
    <h4 class="text-center mb-4">Application Form to the Administration</h4>

    <form action="" method="POST">

        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="mb-3">
                        <?php 
                        $viewQuery = $conn->prepare('SELECT * FROM staff WHERE staffID = ?');
                        $viewQuery->bind_param('s', $emailID); 
                        $viewQuery->execute();
                        $result = $viewQuery->get_result();

                        while ($row = $result->fetch_assoc()) {
                        ?>
                        <label for="requestTitle" class="form-label fw-semibold">From</label>
                        <input label="ad" type="text" class="form-control" value="<?php echo htmlspecialchars($row['staffFullName']); ?>" readonly>
                        <?php } ?>
                    </div>
                </div>
                <div class="col">
                    <div class="mb-3">
                        <label for="requestTitle" class="form-label fw-semibold">To</label>
                        <select class="form-select" name="adminID" >
                            <option disabled selected>Admins</option>
                            <?php 
                            $viewQuery = $conn->prepare('SELECT * FROM admin');
                            $viewQuery->execute();
                            $result = $viewQuery->get_result();
                            while ($row = $result->fetch_assoc()) {
                            ?>
                            <option value="<?php echo $row['adminID']; ?>">
                                <?php echo $row['adminFullName']; ?>
                            </option>
                            <?php }?>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Official Letter</label>
            <textarea name="content" class="form-control" rows="12" required><?php echo 
                "Application Title: [State your title here]\n\n" .
                "Date: " . date("d/m/Y") . "\n\n" .
                "To,\nAdministration,\n\nSir/Madam,\n\nRE: [State the purpose of your request here]\n\nRespectfully, the above matter is referred to.\n\nI, [Full Name], would like to apply for [purpose of request] for the following reasons:\n\n1. [First reason]\n2. [Second reason, if any]\n\nI hope this application will be given due consideration. Your cooperation is highly appreciated.\n\nThank you.\n\nYours sincerely,\n[Full Name]\n[Position / Staff ID]";
            ?></textarea>
            <div class="form-text">Please edit the official letter content as needed.</div>
        </div>

        <div class="text-end">
            <button type="submit" class="btn btn-primary">Submit Application</button>
        </div>
    </form>
</div>
