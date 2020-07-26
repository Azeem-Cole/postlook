<?php
 
    $fname = "";
    $lname = "";
    $email = "";
    $email2 = "";
    $password = "";
    $password2 = "";
    $datetime = "";
    $erro_array = array();
   

    if(isset($_POST['register_button'])){

        $fname = strip_tags($_POST['reg_fname']);
        $fname = str_replace(' ','',$fname);
        $fname = ucfirst(strtolower($fname));
        $_SESSION['reg_fname'] = $fname;

        $lname = strip_tags($_POST['reg_lname']);
        $lname = str_replace(' ','',$lname);
        $lname = ucfirst(strtolower($lname));
        $_SESSION['reg_lname'] = $lname;

        $email = strip_tags($_POST['reg_email']);
        $email = str_replace(' ','',$email);
        $email = ucfirst(strtolower($email));
        $_SESSION['reg_email'] = $email; 

        $email2 = strip_tags($_POST['reg_email2']);
        $email2 = str_replace(' ','',$email2);
        $email2 = ucfirst(strtolower($email2));
        $_SESSION['reg_email2'] = $email2;

        $password = strip_tags($_POST['reg_password']);
        $password2 = strip_tags($_POST['reg_password2']);

        
        $datetime = date("Y-m-d h:i:s");

        if(strlen($fname) > 25 || strlen($fname) < 2){
            array_push($erro_array, "Your first name must be between 2 and 25 characters");
        }

        if(strlen($lname) > 25 || strlen($lname) < 2){
            array_push($erro_array, "Your last name must be between 2 and 25 characters");
        }

        if($email == $email2){
            if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                $email = filter_var($email, FILTER_VALIDATE_EMAIL);
                $email_check = mysqli_query($con, "SELECT email FROM users WHERE email = '$email'");

                $num_rows = mysqli_num_rows($email_check);

                if($num_rows > 0){
                    array_push($erro_array, "Email already in use");
                }

            } else{
                array_push($erro_array, "Invalid email format");
            }
            
        } else{
            array_push($erro_array, "Emails do not match");
        }

        

        if($password != $password2){
            array_push($erro_array, "Passwords do not match");
        } else{
            if (preg_match('/[^A-Za-z0-9]/', $password)){
                array_push($erro_array, "Your password can only contain english characters or numbers");
            }
        }

        if (strlen($password) > 30 || strlen($password) < 5){
            array_push($erro_array, "Your password should be between 5 and 30 characters");
        }

        if (empty($erro_array)){
            $password = md5($password);
            $username = strtolower($fname . "_". $lname);
            $usernameCOM = strtolower($fname . "_". $lname);

            $check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");

            $i = 0;
            while(mysqli_num_rows($check_username_query) != 0){
                $i++;
                $username = $usernameCOM. "_".$i;
                $check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");
            }

            $rand = rand(1, 2);
            if ($rand == 1){
                $profile_pic = "assets\images\profile_pics\defaults\head_deep_blue.png";
            }else if ($rand == 2){
                $profile_pic = "assets\images\profile_pics\defaults\head_emerald.png";
            }

            $query = mysqli_query($con, "INSERT INTO users VALUES ('', '$fname', '$lname', '$username', '$email', '$password', '$datetime','$profile_pic','0', '0','no',',')" );
            array_push($erro_array, "Thank you for registering");
            $_SESSION['reg_fname'] = "";
            $_SESSION['reg_lname'] = "";
            $_SESSION['reg_email'] = "";
            $_SESSION['reg_email2'] = "";
          
            
        }
    }

?>