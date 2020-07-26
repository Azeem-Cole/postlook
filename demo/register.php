<?php
    require 'config/config.php';
    require 'includes/form_handlers/register_handler.php';
    require 'includes/form_handlers/login_handler.php';

?>

<html>
    <head>
        <title>Register</title>
        <link rel="stylesheet" type="text/css" href="assets/css/register_style.css">
    </head>

    <body>
        <div class="wrapper">

            <div id="first">
                <img src="assets/images/backgound/phonegirl.png" style="width:500px; height: 500px;" >  
            </div>

            <div id="second" class="form-wrapper">
                <div class="login_header">
                    <h1>Postlook</h1>
                    <p>login or sign up</p>
                </div>
                <form action="register.php" method ="POST">
                    <input type="email" name="log_email" placeholder="Email Address" value="<?php
                    if(isset($_SESSION['log_email'])){
                        echo $_SESSION['log_email'];
                    }
                    ?>">
                    <br> 
                    <input type="password" name="log_password" placeholder="Password">
                    <br>
                    <input type="submit" name ="login_button" value="Login">

                    <?php
                        if (in_array( "Email or password was incorrect", $erro_array)){
                            echo "Email or password was incorrect<br>";
                        }
                    
                    ?>
                </form>
                <form action="register.php" method ="POST">
                    <input type="text" name="reg_fname" placeholder="First Name" value="<?php 
                    if(isset($_SESSION['reg_fname'])){
                        echo $_SESSION['reg_fname'];
                    }
                    ?>" required>

                    <?php  if(in_array("Your first name must be between 2 and 25 characters", $erro_array)){
                        echo "<br>Your first name must be between 2 and 25 characters";
                    }
                    ?>
                    <br>
                    <input type="text" name="reg_lname" placeholder="last Name" value="<?php 
                    if(isset($_SESSION['reg_lname'])){
                        echo $_SESSION['reg_lname'];
                    }
                    ?>" required>
                    <?php  if(in_array("Your last name must be between 2 and 25 characters", $erro_array)){
                        echo "<br>Your last name must be between 2 and 25 characters";
                    }
                    ?>
                    <br>
                    <input type="email" name="reg_email" placeholder="Email" value="<?php 
                    if(isset($_SESSION['reg_email'])){
                        echo $_SESSION['reg_email'];
                    }
                    ?>" required>

                    
                    <?php  
                    if(in_array("Email already in use", $erro_array)){
                        echo "<br>Email already in use";
                    }
                    if(in_array("Invalid email format", $erro_array)){
                        echo "<br>Invalid email format";
                    }
                    if(in_array("Emails do not match", $erro_array)){
                        echo "<br>Emails do not match";
                    }
                    ?>
                    <br>
                    <input type="email" name="reg_email2" placeholder="Confirm Email" value="<?php 
                    if(isset($_SESSION['reg_email2'])){
                        echo $_SESSION['reg_email2'];
                    }
                    ?>"required>
                    <br>
                    <input type="password" name="reg_password" placeholder="Password" required>
                    <?php  if(in_array("Your password can only contain english characters or numbers", $erro_array)){
                        echo "<br>Your password can only contain english characters or numbers";}

                        if(in_array("Passwords do not match", $erro_array)){
                            echo "<br>Passwords do not match";
                        }
                        
                        if(in_array("Your password should be between 5 and 30 characters", $erro_array)){
                            echo "<br>Your password should be between 5 and 30 characters";
                        }
                    ?>

                    <br>
                    <input type="password" name="reg_password2" placeholder="Confirm Password" required>
                    <br>
                    <input type="submit" name="register_button" value="Register">
                    <?php 
                    if(in_array("Thank you for registering", $erro_array)){
                        echo "<br><h1 style='color:green;'>Thank you for registering</h1>";
                    }
                    ?>
                </form>
            </div>
        </div>
    </body>
</html>