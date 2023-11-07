<?php

include('db_connect.php'); // the database connection...........

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $role = 2; //user role
    $email = trim($_POST['email']);
    $username = $_POST['Username'];
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword'];
    $firstname = ucwords($_POST['firstname']);
    $lastname = ucwords($_POST['lastname']);
    $birthday = $_POST['birthdate'];
    $birthdate = date("Y/m/d", strtotime($birthday));
    $gender = $_POST['gender'];

    // checking password.. it must more than 6 charaters
    $pass_length = strlen($password);
    // checking input, if empty, invalid or password not match........
    // validate the password..........
    if ($password != $confirmpassword) {
        header("location:../register.php?error=Confirm password not match.");
    }
    // checking name. letters only.
    // else if (!preg_match("/^[a-zA-z]*$/", $firstname) || !preg_match("/^[a-zA-z]*$/", $lastname)) {
    //     header("location:../register.php?error=Alphabets and whitespance are only allowed for names");
    // }
    // checking password.. it must more than 6 charaters
    else if ($pass_length < 6) {
        header("location:../register.php?error=Password must more than 6 characters");
    }
    // gender 3 choices only........
    else if ($gender == "---Select your gender---") {
        header("location:../register.php?error=Gender must not empty.");
    } else {
        // checking if username is not use already. 
        $sqlquery = "SELECT * FROM users WHERE username='$username'";
        $result = mysqli_query($con, $sqlquery);
        if (mysqli_num_rows($result) === 1) {
            header("location:../register.php?error=Username is not available, Please Enter unique username");
        }
        // all goods.......data will saved to database.......
        else {
            $pending = "Pending";
            //adding the age automatically.....
            $today = date("Y-m-d");
            $age_cal = date_diff(date_create($birthdate),date_create($today));
            $age_now = $age_cal->format('%y');

            $password = password_hash($confirmpassword, PASSWORD_BCRYPT);
            $query = mysqli_query($con, "INSERT INTO `users`(`firstname`, `lastname`, `role`,`Birthday`, `gender`,`age`,`user_status`,`email_address`, `username`, `password`) 
                VALUES ('" . $firstname . "','" . $lastname . "','" . $role . "','" . $birthdate . "','" . $gender . "','".$age_now."','".$pending."','" . $email . "','" . $username . "','" . $password . "')");
            
            header("location: ../register.php?status=good");
        }
    }
} else {
    header("location: ../register.php?failed=0");
}
