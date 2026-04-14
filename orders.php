<?php

include('connection.php');
$query="select *from orders";
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
                <a class="nav-link" aria-current="page" href="admindish.php">Dishes Management</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="#">Orders</a>
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
    
  </div>
  <div class="feedback">
            <h1 class="header">ORDERS</h1>
            <div>
                <div>
                    <table class="content-table">
                <thead>
                    <tr>
                        <th>ID</th> 
                        <th>CUSTOMER NAME</th>
                        <th>ORDERED DISHES</th>
                        <th>EMAIL</th>
                        <th>TABLE NO</th>
                        <th>DATE</th>
                        <th>ORDER STATUS</th>
                        <th>DELIVERED</th>
                        <th>SERVERED</th>
                        <th>DELETE</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                
                
                while($res=mysqli_fetch_array($queryy)){
                
                
                ?>
                <tr  class="active-row">
                    <td class="order-id"><?php echo $res['id'];?></php></td>
                    <td><?php echo $res['name_cust'];?></php></td>
                    <td class='text-nowrap'><?php echo $res['name_dish'];?></php></td>
                    <td class='text-nowrap email_ord'><?php echo $res['email'];?></php></td>
                    <td ><?php echo $res['table_no'];?></php></td>
                    <td class='text-nowrap'><?php echo $res['date'];?></php></td>
                    <td class='serverd'><?php echo $res['order_status'];?></php></td>
                    <td class="servered-section"><?php echo $res['delivery'];?></php></td>
                    <td><button class="servered-btn btn btn-secondary rounded-pill">SERVERED</button></td>
                    <td><button type="submit" class="btn btn-secondary rounded-pill delete" name="approve"><a href="deleteorder.php?id=<?php echo $res['id']?>"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
  <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
</svg></a></button></td>
                </tr>
               <?php } ?>
                </tbody>
                </table>
                </div>
            </div>
        </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        // Attach a click event to the SERVERED button
        $(".servered-btn").on("click", function () {
            // Get the row of the clicked button
            const row = $(this).closest("tr");
            const orderId = row.find(".order-id").text(); // Assuming 'ID' is in a cell with class 'order-id'

            // Send an AJAX request
            $.ajax({
                url: "update_order_status.php", // Replace with your PHP script URL
                type: "POST",
                data: { id: orderId, status: "Served"}, // Data to send
                success: function (response) {
                    // On success, update the "SERVERED" section with a tick icon
                    row.find(".servered-section").html('&#10003;'); // HTML code for ✓
                    $(row).find(".serverd").text("Served");
                    // HTML code for ✓
                },
                error: function (xhr, status, error) {
                    console.error("Error updating the status:", error);
                    alert("Failed to update the status. Please try again.");
                }
            });
        });
    });
</script>


  

</body>
</html>