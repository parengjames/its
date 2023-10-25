<?php

    include('db_connect.php');// the database connection...........

    if($_SERVER["REQUEST_METHOD"] == "POST"){

        $role = 2;//user role
        $email = trim($_POST['email']);
        $username = $_POST['Username'];
        $password = $_POST['password'];
        $confirmpassword = $_POST['confirmpassword'];
        $firstname = ucwords($_POST['firstname']);
        $lastname = ucwords($_POST['lastname']);
        $gender = $_POST['gender'];

        // checking input, if empty, invalid or password not match........
        if($email === ""){
            header("location: ../register.php?error=Email address cannot be empty, try again!");
        }else if($username === ""){
            header("location: ../register.php?error=Username cannot be empty, try again!");
        }else if($password === ""){
            header("location: ../register.php?error=Password cannot be empty, try again!");
        }else if($confirmpassword === ""){
            header("location: ../register.php?error=Confirm Password cannot be empty, try again!");
        }else if($confirmpassword != $password){
            header("location: ../register.php?error=Password not match, try again!");
        }else if($firstname === ""){
            header("location: ../register.php?error=Please provide your first name and try again!");
        }else if($lastname === ""){
            header("location: ../register.php?error=Please provide your last name and try again!");
        }else if($gender === "---Select your gender---"){
            header("location: ../register.php?error=Please select your gender.");
        }
        else{
            // checking if username is not use already. 
            $sqlquery = "SELECT * FROM users WHERE username='$username'";
            $result = mysqli_query($con,$sqlquery);
            if (mysqli_num_rows($result) === 1) {
                header("location:../register.php?error=Username is not available, Please Enter unique username");
            }
            // all goods.......data will saved to database.......
            else{
                $password = password_hash($confirmpassword,PASSWORD_BCRYPT);
                $query = mysqli_query($con,"INSERT INTO `users`(`firstname`, `lastname`, `role`, `gender`, `email_address`, `username`, `password`) 
                VALUES ('".$firstname."','".$lastname."','".$role."','".$gender."','".$email."','".$username."','".$password."')");
                
                header("location: ../register.php?status=good");
            }
        }
    }else{
        header("location: ../register.php?failed=0");
    }