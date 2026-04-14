<?php
require_once('connection.php');

if(isset($_POST['login']))
{
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $pass  = mysqli_real_escape_string($con, $_POST['pass']);

    if(empty($email) || empty($pass))
    {
        echo '<script>alert("Please fill all fields")</script>';
    }
    else
    {
        $query = "SELECT * FROM users WHERE email='$email'";
        $res   = mysqli_query($con, $query);

        if($row = mysqli_fetch_assoc($res))
        {
            $db_password = $row['password'];

            // ✅ Correct password check
            if(password_verify($pass, $db_password))
            {
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $row['name'];
                $_SESSION['useremail'] = $row['email'];

                // ⚠️ IMPORTANT: no alert before header
                header('Location: menu.php');
                exit();
            }
            else
            {
                echo '<script>alert("Incorrect password")</script>';
            }
        }
        else
        {
            echo '<script>alert("Email not found")</script>';
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <title>Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>

<body>
    <div>
        <div class="container-fluid text-start contact">
          <div class="row">
            <div class="col-lg-6 p-5 centerImage"> 
                <img src="img/chad-montano-eeqbbemH9-c-unsplash.jpg" alt="">
            </div>
              <div class="col-lg-6 p-5">
                <div id="main-container" class="centered-flex">
                    <div class="form-container">
                        <div class="icon centered-flex"><i class="fa fa-user"></i></div>
                        <div class="title">LOGIN</div>
                        <form id="login-form" class="centered-flex" method='POST'>
                            <div class="msg"></div>
                            <div class="field">
                                <input type="text" placeholder="email" id="uname" name='email'>
                                <i class="fa fa-user"></i>
                            </div>
                            <div class="field">
                                <input type="password" placeholder="Password" id="pass" name='pass'>
                                <i class="fa fa-lock"></i>
                            </div>
                            <div class="action centered-flex">
                                <label for="remember" class="centered-flex">
                                    <input type="checkbox" id="remember"> Remember me
                                </label>
                                <a href="#">Forget Password ?</a>
                            </div>
                            <div class="btn-container"><button id="btn" class="rounded-pill px-5" name='login'>Login</button></div>
                            <div class="signup">Don't have an Account?<a href="signup.php"> Sign up</a></div>
                        </form>
                    </div>
                </div>
              </div>
            </div>
         </div>
         </div>
    
    <script src="js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>