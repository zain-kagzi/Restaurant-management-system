<?php
include('connection.php');
    if(isset($_POST['adlog'])){
        $id=$_POST['adid'];
        $pass=$_POST['adpass'];
        
        
        if(empty($id)|| empty($pass))
        {
            echo '<script>alert("please fill the blanks")</script>';
        }

        else{
            $query="select * from admin where admin='$id'";
            $res=mysqli_query($con,$query);
            if($row=mysqli_fetch_assoc($res)){
                $db_password = $row['password'];
                if($pass  == $db_password)
                {
                    
                    // session_start();
                    // $_SESSION['email'] = $email;
                    echo '<script>alert("Welcome ADMINISTRATOR!");</script>';
                    header("location: admindash.php");
                    
                }
                else{
                    echo '<script>alert("Enter a proper password")</script>';
                }
            }
            else{
                echo '<script>alert("enter a proper email")</script>';
            }
        }
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <style>
    body {
      background-color:rgb(81, 81, 82);
      font-family: "Segoe UI", sans-serif;
      display: flex;
            justify-content: center;
            align-items: center;
    }
    .login-card {
    
      border-radius: 12px;
      box-shadow: 0 0 12px rgba(0, 0, 0, 0.08);
      padding: 40px;
    }
    .form-control:focus {
      border-color: #198754;
      box-shadow: none;
    }
    .login-btn {
      background-color: #198754;
      color: #fff;
    }
    .login-btn:hover {
      background-color: #157347;
    }
    .illustration-img {
      max-width: 100%;
      height: auto;
    }
    .small-link {
      font-size: 14px;
    }

    </style>
</head>
<body>
  

<div class="container my-5">
  <div class="row justify-content-center align-items-center">
    <div class="col-lg-10 col-md-12">
      <div class="row g-4 login-card bg-white">
        <!-- Form Section -->
        <div class="col-md-6">
          <h4 class="mb-2">Admin/Staff Login</h4>
          <p class="text-muted small">Please log in to continue:</p>


          <form method="POST">
            <div class="mb-3">
              <label class="form-label">USERNAME</label>
              <input class="form-control" placeholder="Enter your username" type="text" id="username" name="adid" required/>
            </div>

            <div class="mb-3">
              <label for="password" class="form-label">PASSWORD</label>
              <input type="password" class="form-control" id="password" name="adpass" placeholder="Enter your password" />
              <div class="text-end">
                <a href="#" class="small-link">Forgot Password</a>
              </div>
            </div>

            <button type="submit" class="btn login-btn w-100" value="LOGIN" name="adlog">Log In</button>
          </form>
        </div>

        <!-- Image Section -->
        <div class="col-md-6 text-center d-none d-md-block">
          <img src="img/6310507.jpg" alt="Login Illustration" class="illustration-img">
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Bootstrap JS (Optional if no JS components used) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>