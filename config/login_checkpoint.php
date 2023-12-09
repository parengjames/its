<?php
session_start();

// database connection should integrated here
include('db_connect.php');

//checking if username and password is not empty..........
if(isset($_POST['username']) && isset($_POST['password'])){

    // validate the data format.......
    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
     }
    
     $uname = validate($_POST['username']);
     $password = validate($_POST['password']);

     if(empty($uname) && empty($password)){
        header("location:../login");
     }else if(empty($uname)){
        header("location: ../login.php?error=Username is required");
     }else if(empty($password)){
        header("location: ../login.php?error=Password is required");
    
     }else{
        //  all inputs is good to validate...............
        $sqlquery = "SELECT * FROM users WHERE username='$uname'";
        
        $query_result = mysqli_query($con, $sqlquery);

        // checking database table if data is available.......
        if(mysqli_num_rows($query_result) != null){
            $rows = mysqli_fetch_assoc($query_result);
            // validating username...........
            if($rows['username'] === $uname){
                //validating password over hash.........
                if(password_verify($password,$rows['password'])){
                    if($rows['role'] == 1){
                        $_SESSION['loggedin'] = true;
                        $_SESSION['user_id'] = $rows['user_id'];
                        $_SESSION['username'] = $rows['username'];
                        $_SESSION['login_role'] = $rows['role'];
                        $_SESSION['firstname'] = $rows['firstname'];
                        $_SESSION['lastname'] = $rows['lastname'];
    
                        $login = "login";
                        $logvalue = 1;
                        //saving login logs to db.......
                        $sqlquery1 = mysqli_query($con,"INSERT INTO `action_logs`(`user_id`, `log_name`, `log_value`) 
                        VALUES ('".$rows['user_id']."','".$login."','".$logvalue."')");
    
                        header("location:../app/index");
                    }
                    else if($rows['user_status'] == "Approved"){
                        $_SESSION['loggedin'] = true;
                        $_SESSION['user_id'] = $rows['user_id'];
                        $_SESSION['username'] = $rows['username'];
                        $_SESSION['login_role'] = $rows['role'];
                        $_SESSION['firstname'] = $rows['firstname'];
                        $_SESSION['lastname'] = $rows['lastname'];
    
                        $login = "login";
                        $logvalue = 1;
                        //saving login logs to db.......
                        $sqlquery1 = mysqli_query($con,"INSERT INTO `action_logs`(`user_id`, `log_name`, `log_value`) 
                        VALUES ('".$rows['user_id']."','".$login."','".$logvalue."')");
    
                        header("location:../app/index");
                    }else{
                        header("location:../login.php?return=The account is pending approval from the administrator.");
                    }

                }else{
                    header("location:../login.php?return=The username or password entered is incorrect.");
                }
            }else{
                header("location:../login.php?return=Username or Password entered is incorrect");
            }
        }
        else{
            header("location:../login.php?return=Try again, Username or Password is incorrect");
        }
    }
}
