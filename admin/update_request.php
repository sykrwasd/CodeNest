<?php 

        include('../config/database.php');

        $updateID = $_POST['updateID'];

        $update = "UPDATE request_updates SET status='Read' WHERE updateID=$updateID";
        $result = mysqli_query($conn, $update);

        if($result){
               echo '<script> alert("Updated");
                        window.history.back();
                         </script>';
        }else{
            echo "error";
        }

?>