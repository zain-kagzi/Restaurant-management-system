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
</head>
<body>
  <div  id="main">
    <nav class="navbar navbar-expand-lg navp">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="img/pngegg.png" alt="Logo" class="d-inline-block align-text-top logo">
                
            </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 nav-underline">
              <li class="nav-item">
                <a class="nav-link" aria-current="page" href="admindash.php">Feedback</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="admindish.php">Dishes Management</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="orders.php">Orders</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="adminusers.php">Users</a>
              </li>
            </ul>
            <form class='d-flex' role='search'>
              <button class='btn btn-warning rounded-pill px-5'><a href='index.php' class='login'>Home</a></button></a>
            </form>
          </div>
        </div>
      </nav>

      <!-- 1st section -->
      <div class="feedback">
          <div class="d-grid gap-2 d-md-flex justify-content-md-between">
            <h1 class="header">DISHES</h1>
            <button class=" addbtn btn btn-outline-info me-md-2 mb-2" type="button"><a href="adddishes.php">+ ADD DISHES</a></button>
            </div>

            <div>
                <div>
                    <table class="content-table">
                <thead>
                    <tr>
                        <th>DISH_ID</th> 
                        <th>TYPE</th>
                        <th>NAME</th> 
                        <th>PRICE</th>
                        <th>DELETE DISH</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                
                
                while($res=mysqli_fetch_array($queryy)){
                
                
                ?>
                <tr  class="active-row">
                    <td><?php echo $res['id'];?></php></td>
                    <td><?php echo $res['type'];?></php></td>
                    <td><?php echo $res['name'];?></php></td>
                    <td><?php echo $res['price'];?></php></td>
                    <td><button type="submit" class="btn btn-secondary rounded-pill delete" name="approve"><a href="deletedish.php?id=<?php echo $res['id']?>">DELETE DISH</a></button></td>
                </tr>
               <?php } ?>
                </tbody>
                </table>
                </div>
            </div>
        </div>
      </div>
  </div>
  

  

</body>
</html>