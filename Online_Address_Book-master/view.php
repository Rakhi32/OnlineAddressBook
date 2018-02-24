<?php
session_start();

if(isset($_SESSION['usr_id'])  && isset($_SESSION['email'])) {
  
  header("Location: home.php");

}



?>




<!DOCTYPE html>
<html>
<head>
  <title>Phone Book</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport" >
  <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
   <link href='img/pb1.png' rel='icon' type='image/x-icon'/>
  <style>
  body  {
      background-image: url("img/4.jpg");
      background-color: #cccccc;
  }
  </style>

</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php">Home</a>
    </div>
    <div class="collapse navbar-collapse" id="navbar1">
      <ul class="nav navbar-nav navbar-right">
        <?php if (isset($_SESSION['usr_id'])) { ?>
        <li><a href="home.php"> <span class="glyphicon glyphicon-plus-sign"></span>   Add</a></li>
        <li><a href="edit.php"> <span class="glyphicon glyphicon-edit"></span>  Edit</a></li>
        <li><a href="view.php"> <span class="glyphicon glyphicon-eye-open"></span>  View</a></li>
        <li><a href="delete.php"> <span class="glyphicon glyphicon-remove"></span>  Delete</a></li>
        <li><a href="search.php"> <span class="glyphicon glyphicon-search"></span>  Search</a></li>
        <li><p class="navbar-text">Hi! <span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION['usr_name']; ?></p></li>
        <li><a href="logout.php"> <span class="glyphicon glyphicon-log-out"></span> Log Out</a></li>
        <?php } else { ?>
        <li><a href="login.php"><span class="glyphicon glyphicon-log-in"> Login</a></li>
        <li class="active"><a href="register.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
</nav>


<center> 
 <legend><h1>Your Contacts</h1></legend>
</center>
<span class="text-success"><?php if (isset($successmsg)) { echo $successmsg; } ?></span>
<span class="text-danger"><?php if (isset($errormsg)) { echo $errormsg; } ?></span>
  
    
 

          <div class="container">

            <div class="row">
              
               
            <br><br>
            <table id="myTable" class="table table-bordered ">
        <thead>
          <tr class="header">
              <th class="text-center">Id</th>
              <th class="text-center">Name</th>
              <th class="text-center">Address</th>
              <th class="text-center">Email</th>
            <th class="text-center">Mobile</th>
             
          </tr>
 
      
      <?php
      include_once 'dbconnect.php';
 
      mysql_connect("localhost","root","");
      mysql_select_db("my_database");

      $userid=$_SESSION['usr_id'];
 
      $query=mysql_query("SELECT * FROM userinfo WHERE userID=$userid");

      if($query === FALSE) { 
        die(mysql_error()); // TODO: better error handling
      }

       while($arr=mysql_fetch_array($query)) {


       ?>
        </thead>
        <tbody>
          <tr>

              <td color="white" class="text-center"><?php echo $arr[1];?></td>
              <td class="text-center"><?php echo $arr[2];?></td>
              <td class="text-center"><?php echo $arr[3];?></td>
              <td class="text-center"><?php echo $arr[4];?></td>
              <td class="text-center"><?php echo $arr[5];?></td>
              

          <?php
      }
    ?>
        </tbody>
      </table>



            </div>

        </div>

        <br>
 

<script src="js/jquery-1.10.2.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>


<script>
function myFunction() {
  // Declare variables
  var input, filter, table, tr, td, i;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
</script>

  

 