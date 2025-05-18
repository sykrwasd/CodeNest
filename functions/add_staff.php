<?php
include'../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Getting staff info
    $firstname = $_POST['fname'];
    $lastname = $_POST['lname'];
    $fullname = $firstname . ' ' . $lastname;

    $dob = $_POST['dob'];
    $pnum = $_POST['pnum'];
    $email = $_POST['email'];
    $position = $_POST['position'];
    $citizen = $_POST['citizen'];
    $salary = $_POST['salary'];

    $address1 = $_POST['address1'];
    $address2 = $_POST['address2'];
    $postcode = $_POST['postcode'];
    $state = $_POST['state'];
    $country = $_POST['country'];

    $fulladdress = $address1 . ' ' . $address2 . ' ' . $postcode . ' ' . $state . ' ' . $country;

    // Handle image upload
    $targetDir = "../img/";
    $imageName = preg_replace("/[^a-zA-Z0-9]/", "", $firstname . $lastname) . ".jpg";
    $targetFile = $targetDir . $imageName;

    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Only allow JPG files
    if ($imageFileType !== "jpg") {
        die("Only JPG files are allowed.");
    }

    if (move_uploaded_file($_FILES["picture"]["tmp_name"], $targetFile)) {
        // File uploaded successfull

        // Insert into database
       $insertQuery = "INSERT INTO staff (fullname, dob, phone_number, email, position, citizen_id, salary, address, imagepath)
VALUES ('$fullname','$dob','$pnum','$email','$position','$citizen','$salary','$fulladdress', '$imageName')";


        $result = mysqli_query($conn, $insertQuery);

        if ($result) {
              echo "<script>alert('Staff Added Succesfully');
              window.history.back();
              </script>";
          
        } else {
                echo "<script>alert('Database Error: " . mysqli_error($conn) . "');</script>";
        }

    } else {
        echo "Sorry, there was an error uploading the picture.";
    }
}
?>
