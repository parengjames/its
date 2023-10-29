<?php


include('../../config/db_connect.php'); // the database connection...........

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $role = $_POST['privilege']; //user role
    $email = trim($_POST['email']);
    $username = $_POST['Username'];
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword'];
    $firstname = ucwords($_POST['firstname']);
    $lastname = ucwords($_POST['lastname']);
    $birthday = $_POST['birthdate'];
    $birthdate = date("Y/m/d", strtotime($birthday));
    $gender = $_POST['gender'];
    $approval = "Approved";

    // checking password.. it must more than 6 charaters
    $pass_length = strlen($password);
    // checking input, if empty, invalid or password not match........
    // validate the password..........
    if ($password != $confirmpassword) {
        $_SESSION['ico'] = "error";
        $_SESSION['title'] = "Password not match, Try again.";
        header("location: ../index.php?page=_students&status=return");
    }
    // checking name. letters only.
    else if (!preg_match("/^[a-zA-z]*$/", $firstname) || !preg_match("/^[a-zA-z]*$/", $lastname)) {
        $_SESSION['ico'] = "error";
        $_SESSION['title'] = "Only Alphabets and whitespace are allowed for Names";
        header("location: ../index.php?page=_students&status=return");
    }
    // checking password.. it must more than 6 charaters
    else if($pass_length < 6){
        $_SESSION['ico'] = "error";
        $_SESSION['title'] = "Password must be more than 6 characters";
        header("location: ../index.php?page=_students&status=return");
    }
    // gender 3 choices only........
    else if($gender == "---Select your gender---"){
        $_SESSION['ico'] = "error";
        $_SESSION['title'] = "Gender must not empty, Please select gender";
        header("location: ../index.php?page=_students&status=return");
    }
    // privilege............
    else if($role == "---Select Privilege---"){
        $_SESSION['ico'] = "error";
        $_SESSION['title'] = "Role must not empty, Please select gender";
        header("location: ../index.php?page=_students&status=return");
    }
    else {
        // checking if username is not use already. 
        $sqlquery = "SELECT * FROM users WHERE username='$username'";
        $result = mysqli_query($con, $sqlquery);
        if (mysqli_num_rows($result) === 1) {
            $_SESSION['ico'] = 'warning';
            $_SESSION['title'] = 'Username is not available';
            header("location:../index.php?page=_students&status=used");
            exit();
        }
        // all goods.......data will saved to database.......
        else {
            // setting user privilege...........
            $privilege;
            if($role == "Admin"){
                $privilege = 1;
            }else{
                $privilege = 2;
            }
            //adding the age automatically.....
            $today = date("Y-m-d");
            $age_cal = date_diff(date_create($birthdate),date_create($today));
            $age_now = $age_cal->format('%y');

            $password = password_hash($confirmpassword, PASSWORD_BCRYPT);
            $query = mysqli_query($con, "INSERT INTO `users`(`firstname`, `lastname`, `role`,`Birthday`, `gender`,`age`,`user_status`, `email_address`, `username`, `password`) 
                VALUES ('" . $firstname . "','" . $lastname . "','" . $privilege . "','" . $birthdate . "','" . $gender . "','".$age_now."','".$approval."','" . $email . "','" . $username . "','" . $password . "')");

            $_SESSION['ico'] = 'success';
            $_SESSION['title'] = 'Registration is successful';
            header("location: ../index.php?page=_students&status=success");
            exit();
        }
    }
} else {
    $_SESSION['ico'] = 'error';
    $_SESSION['title'] = 'Registration failed, Try again';
    header("location: ../index.php?page=_students&status=failed");
}
