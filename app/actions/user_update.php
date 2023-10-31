<?php
include('../../config/db_connect.php'); // the database connection...........
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $userid = $_POST['id'];
    $email_add = $_POST['email'];
    $password = $_POST['password'];
    $_confirmpass = $_POST['confirmpassword'];
    $role = $_POST['Privilege'];
    $fname = $_POST['Firstname'];
    $lname = $_POST['Lastname'];
    $bdate = $_POST['Birthdate'];
    $formatted_birthdate = date("Y/m/d", strtotime($bdate));
    $gender = $_POST['Gender'];

    $pass_length = strlen($password);
    //adding the age automatically.....
    $today = date("Y-m-d");
    $age_cal = date_diff(date_create($formatted_birthdate), date_create($today));
    $age_now = $age_cal->format('%y');

    //retrieving data of user from database..........
    $sqlquery = mysqli_query($con, "SELECT * FROM users WHERE `user_id`='$userid'");
    $_result = mysqli_num_rows($sqlquery);
    if ($_result > 0) {
        while ($row = mysqli_fetch_assoc($sqlquery)) {

            //if user's password is remained old...............
            if ($password == "" && $_confirmpass == "") {
                $newpassword = $row['password'];
                //begin the update query...........
                $update_query = mysqli_query($con, "UPDATE `users` SET `firstname`='" . $fname . "',`lastname`='" . $lname . "',
                                `role`='" . $role . "',`Birthday`='" . $formatted_birthdate . "',`gender`='" . $gender . "',`age`='" . $age_now . "',`email_address`='" . $email_add . "',`password`='" . $newpassword . "'
                                WHERE `user_id` = '" . $userid . "'");

                $_SESSION['ico'] = 'success';
                $_SESSION['title'] = 'Updated successfully';
                header("location: ../index.php?page=_students&status=success");
            
            // if admin want to change/reset the user password...............
            } else {
                if ($password == "" || $_confirmpass == "") {
                    $_SESSION['ico'] = "warning";
                    $_SESSION['title'] = "Password or confirmpassword is empty. Input something!";
                    header("location: ../index.php?page=_students&status=return");
                } else if ($password != $_confirmpass) {
                    $_SESSION['ico'] = "error";
                    $_SESSION['title'] = "Password not match, Try again.";
                    header("location: ../index.php?page=_students&status=return");
                }else if($pass_length < 6){
                    $_SESSION['ico'] = "error";
                    $_SESSION['title'] = "Password must be more than 6 characters";
                    header("location: ../index.php?page=_students&status=return");
                } else {
                    $_pass = password_hash($_confirmpass, PASSWORD_BCRYPT);
                    //begin the update query...........
                    $update_query = mysqli_query($con, "UPDATE `users` SET `firstname`='" . $fname . "',`lastname`='" . $lname . "',
                    `role`='" . $role . "',`Birthday`='" . $formatted_birthdate . "',`gender`='" . $gender . "',`age`='" . $age_now . "',`email_address`='" . $email_add . "',`password`='" . $_pass . "'
                    WHERE `user_id` = '" . $userid . "'");

                    $_SESSION['ico'] = 'success';
                    $_SESSION['title'] = 'Updated successfully';
                    header("location: ../index.php?page=_students&status=success");
                }
            }
        }
    } else {
        $_SESSION['ico'] = 'error';
        $_SESSION['title'] = 'No result from database';
        header("location: ../index.php?page=_students&status=failed");
    }
} else {
    $_SESSION['ico'] = 'error';
    $_SESSION['title'] = 'Cannot Proceed, No data recieved.';
    header("location: ../index.php?page=_students&status=failed");
}
