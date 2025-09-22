<?php
include('session_m.php');

if(!isset($login_session)){
    header('Location: managerlogin.php'); // Redirecting To Home Page
    exit();
}
?>
<!DOCTYPE html>
<html>

<head>
    <title> Manager Login | Food Exploria </title>
    <link rel="stylesheet" type="text/css" href="css/delete_food_items.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
</head>

<body>

<!--Back to top button-->
<button onclick="topFunction()" id="myBtn" title="Go to top">
  <span class="glyphicon glyphicon-chevron-up"></span>
</button>

<script type="text/javascript">
  window.onscroll = function() { scrollFunction() };
  function scrollFunction(){
      if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
          document.getElementById("myBtn").style.display = "block";
      } else {
          document.getElementById("myBtn").style.display = "none";
      }
  }
  function topFunction() {
      document.body.scrollTop = 0;
      document.documentElement.scrollTop = 0;
  }
</script>

<nav class="navbar navbar-inverse navbar-fixed-top navigation-clean-search" role="navigation">
  <div class="container">
    <div class="navbar-header">
      <a class="navbar-brand" href="index.php">Food Exploria</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="index.php">Home</a></li>
        <li><a href="aboutus.php">About</a></li>
        <li><a href="contactus.php">Contact Us</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><span class="glyphicon glyphicon-user"></span> Welcome <?php echo $login_session; ?> </a></li>
        <li class="active"> <a href="managerlogin.php">MANAGER CONTROL PANEL</a></li>
        <li><a href="logout_m.php"><span class="glyphicon glyphicon-log-out"></span> Log Out </a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container">
    <div class="jumbotron">
        <h1>Hello Manager! </h1>
        <p>Manage all your restaurant from here</p>
    </div>
</div>

<div class="container">
    <div class="col-xs-3" style="text-align: center;">
        <div class="list-group">
            <a href="view_food_items.php" class="list-group-item">View Food Items</a>
            <a href="add_food_items.php" class="list-group-item">Add Food Items</a>
            <a href="edit_food_items.php" class="list-group-item">Edit Food Items</a>
            <a href="delete_food_items.php" class="list-group-item active">Delete Food Items</a>
            <a href="view_order_details.php" class="list-group-item">View Order Details</a>
        </div>
    </div>

    <div class="col-xs-9">
      <div class="form-area" style="padding: 0px 100px 100px 100px;">
        <form action="delete_food_items1.php" method="POST">
        <br style="clear: both">
        <h3 style="margin-bottom: 25px; text-align: center; font-size: 30px;"> DELETE YOUR FOOD ITEMS FROM HERE </h3>

<?php
// Lấy tất cả món ăn từ bảng food
require_once('connection.php');
$conn = Connect();
$sql = "SELECT * FROM food ORDER BY F_ID";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
?>

<table class="table table-striped">
  <thead class="thead-dark">
    <tr>
      <th>#</th>
      <th>Food ID</th>
      <th>Food Name</th>
      <th>Price</th>
      <th>Description</th>
      <th>Restaurant ID</th>
      <th>Image</th>
    </tr>
  </thead>

<?php
  while($row = mysqli_fetch_assoc($result)){
?>
  <tbody>
    <tr>
      <td> <input name="checkbox[]" type="checkbox" value="<?php echo $row['F_ID']; ?>"/> </td>
      <td><?php echo $row["F_ID"]; ?></td>
      <td><?php echo $row["name"]; ?></td>
      <td><?php echo $row["price"]; ?></td>
      <td><?php echo $row["description"]; ?></td>
      <td><?php echo $row["R_ID"]; ?></td>
      <td><img src="<?php echo $row["images_path"]; ?>" width="80" height="60"></td>
    </tr>
  </tbody>
<?php } ?>
</table>
<br>
<div class="form-group">
  <button type="submit" id="submit" name="delete" value="Delete" class="btn btn-danger pull-right"> DELETE</button>    
</div>

<?php } else { ?>
<h4><center>0 RESULTS</center> </h4>
<?php } ?>

        </form>
      </div>
    </div>
</div>

</body>

<footer class="container-fluid bg-4 text-center">
<br>
<p> Food Exploria 2017 | &copy All Rights Reserved </p>
<br>
</footer>
</html>
