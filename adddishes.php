<?php

include('connection.php');
$query="select *from menu_items";
$queryy=mysqli_query($con,$query);
$num=mysqli_num_rows($queryy);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/admindash.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <style>
        h2{
            color:#fff;
        }
        form {
            background: transparent;
            padding: 20px;
            border:1px solid #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            max-width: 800px;
            width: 100%;
            position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
        }
        label {
            display: block;
            margin-bottom: 8px;
            color:#fff;
        }
        input, textarea,select {
            background:transparent;
            color:#fff;
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border:none;
            border-radius: 5px;
            border-bottom: 1px solid #404040
        }
        option{
            background-color:black !important;
        }
        .btnn {
            background-color: #007BFF;
            color: white;
            border: none;
            cursor: pointer;
            width: 30%;
        }
        .btnn:hover {
            background-color: #0056b3;
        }
        
    </style>
</head>
<body>
<div class="d-grid gap-2 d-md-flex justify-content-md-between mx-5 navbar navbar-expand-lg ">
        <img src="img/pngegg.png" alt="Logo" class="d-inline-block align-text-top logo">
                
        <button class='btn btn-warning rounded-pill px-5'><a href='admindish.php' class='login'>Home</a></button></a>
</div>
<form action="upload.php" method="POST" enctype="multipart/form-data">
        <h2>Upload Dish</h2>
        <input type="text" id="name" name="name" placeholder='Name' required>

<select id="type" name="type" required>
  <option value="" disabled selected>Select Type</option>
  <option value="best">Best</option>
  <option value="salads">Salads</option>
  <option value="sandwich">Sandwich</option>
  <option value="dishes">Dishes</option>
</select>
        <input type="text" id="price" name="price" placeholder='Price' required>
        <input type="file" name="image" required>

        <input type="submit" class="btnn"  value="ADD DISH" name="adddish">
    </form>

</body>
</html>