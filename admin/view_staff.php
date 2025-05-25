<?php 

    include('../config/database.php')

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar With Bootstrap</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/view_staff.css">
</head>

<body>
   
                <h2 style="text-align: center;">Staff List</h2>
                <table class="table table-bordered">
                        <thead>
                      
                    <tr class="table-primary">
                        <th scope="col">Staff Image</th>
                        <th scope="col">Full Name</th>
                        <th scope="col">Phone Number</th>
                        <th scope="col">Company Email</th>
                        <th scope="col">Position</th>
                        <th scope="col">Hire Date</th>
                        <th scope="col">Actions</th>
                      </>
                      <?php 
                        $i = 1;
                        $viewQuery = $conn -> prepare('SELECT * from staff');
                                                $viewQuery  -> execute();
                                                $result = $viewQuery -> get_result();
                        while ($row = $result->fetch_assoc()) {
                        
                        ?>
                        <tr>
                            <th scope="row">
                                <img src="../img/<?php echo $row['staffPicture'];?>" width="60">
                            </th>
                            <td><?php echo $row['staffFullName']; ?></td>
                            <td><?php echo $row['staffNoPhone']; ?></td>
                            <td><?php echo $row['staffEmail']; ?></td>
                            <td><?php echo $row['staffRole']; ?></td>
                            <td><?php echo $row['staffHireDate']; ?></td>
                            <td> <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal" id="print">
                                View Details</button>
                            </td>
                        </tr>
                        <?php } ?>
                      </thead>
                    
                      
                </table>

                <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"> Title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="modalBody">

                    <table class="table table-bordered">
                        <thead>
                      
                    <tr class="table-primary">
                        <th scope="col">Staff Image</th>
                        <th scope="col">Full Name</th>
                        <th scope="col">Phone Number</th>
                        <th scope="col">Company Email</th>
                        <th scope="col">Position</th>
                        <th scope="col">Hire Date</th>
                        <th scope="col">Actions</th>
                      </>
                      <?php 
                        $i = 1;
                        $viewQuery = $conn -> prepare('SELECT * from staff');
                                                $viewQuery  -> execute();
                                                $result = $viewQuery -> get_result();
                        while ($row = $result->fetch_assoc()) {
                        
                        ?>
                        <tr>
                            <th scope="row">
                                <img src="../img/<?php echo $row['staffPicture'];?>" width="60">
                            </th>
                            <td><?php echo $row['staffFullName']; ?></td>
                            <td><?php echo $row['staffNoPhone']; ?></td>
                            <td><?php echo $row['staffEmail']; ?></td>
                            <td><?php echo $row['staffRole']; ?></td>
                            <td><?php echo $row['staffHireDate']; ?></td>
                            
                        </tr>
                        <?php } ?>
                      </thead>
                    
                      
                </table>
                            
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                       
                    </div>
                    </div>
                </div>
                </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
    <script src="test.js"></script>
</body>

</html>