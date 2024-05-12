<?php
session_start();
include_once "config.php";
$fname = mysqli_real_escape_string($conn, $_POST['fname']);
$lname = mysqli_real_escape_string($conn, $_POST['lname']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

if (!empty($fname) && !empty($lname) && !empty($email) && !empty($password)) {
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) { // check if email is valid
        $checkEmailQuery = mysqli_query($conn, "SELECT email FROM users WHERE email = '{$email}'"); // check if email already exist or not in database
        if (mysqli_num_rows($checkEmailQuery) > 0) {
            echo "$email - Email already exist!";
        } else {
            if (isset($_FILES['image'])) { // check if user upload file or not
                $imgName = $_FILES['image']['name']; // getting user uploaded img name
                // $imgType = $_FILES['image']['type']; // getting user upload img type
                $tmpName = $_FILES['image']['tmp_name']; // temp name is used to save/move file to our folder

                $imgExplode = explode('.', $imgName); // get extension of img like jpg png jpeg
                $imgExtension = end($imgExplode); // get the extension of an user uploaded img file
                $validExtensions = ['png', 'jpeg', 'jpg']; // valid extensions for images

                if (in_array($imgExtension, $validExtensions) === true) { // check if uploaded img have valid extension
                    $time = time(); // time will be added to img file name before uploading
                    $newImgName = $time . $imgName;
                    $createAt = date('Y-m-d H:i:s');

                    if (move_uploaded_file($tmpName, "../images/" . $newImgName)) { // move uploaded img to images folder
                        $status = "Active now"; // once user singned up status will be active now
                        $randomId = rand(time(), 10000000); // random id for user

                        $insertUserDataQuery = mysqli_query($conn, "INSERT INTO users (unique_id, fname, lname, email, password, img, status, created_at)
                                               VALUES ({$randomId}, '{$fname}', '{$lname}', '{$email}', '{$password}', '{$newImgName}', '{$status}', '{$createAt}')"); // insert data of user

                        if ($insertUserDataQuery) { // if data is inserted
                            $fetchUinqueId = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
                            if (mysqli_num_rows($fetchUinqueId) > 0) {
                                $row = mysqli_fetch_assoc($fetchUinqueId);
                                $_SESSION['unique_id'] = $row['unique_id']; // using unique id to start session
                                echo "success";
                            } else {
                                echo "Something went wrong!";
                            }
                        }
                    }
                } else {
                    echo "Please select an Image file - jpeg, jpg, png!";
                }
            } else {
                echo "Please select an Image file!";
            }
        }
    } else {
        echo "$email - This is not a valid email!";
    }
} else {
    echo "All input fields are required!";
}
?>