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
    <link rel="stylesheet" href="style.css">
</head>

<body>
   
                <h2 style="text-align: center;">Staff List</h2>
                <table class="table table-bordered">
                        <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Full Name</th>
                        <th scope="col">Phone Number</th>
                        <th scope="col">Company Email</th>
                        <th scope="col">Position</th>
                        <th scope="col">Salary</th>
                        <th scope="col">Address</th>
                      </tr>
                      <?php 
                        $i = 1;
                        $viewQuery = $conn -> prepare('SELECT * from staff');
                                                $viewQuery  -> execute();
                                                $result = $viewQuery -> get_result();
                        while ($row = $result->fetch_assoc()) {
                        ?>
                        <tr>
                            <th scope="row"><?php echo $i++; ?></th>
                            <td><?php echo $row['fullname']; ?></td>
                        
                        </tr>
                        <?php } ?>
                      </thead>
                    
                      
                </table>


    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
    <script src="test.js"></script>
</body>

</html>