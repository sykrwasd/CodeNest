<?php 

        include('../config/database.php');

        $updateID = $_POST['updateID'];

        $update = "DELETE FROM request_updates WHERE updateID=$updateID";
      
        $result = mysqli_query($conn, $update);

        if($result){
               echo '<script> alert("Deleted");
                        window.history.back();
                         </script>';
        }else{
            echo "error";
        }

?>