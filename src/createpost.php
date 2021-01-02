<!DOCTYPE html>
<html lang="en">
<head>

  
  <title>Assignment</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="bootstrap-3.4.1-dist/css/bootstrap.min.css" >
   <script src="bootstrap-3.4.1-dist/jquery-3.2.1.slim.min.js" ></script>
<script src="bootstrap-3.4.1-dist/js/bootstrap.min.js" ></script>
</head>
<body>

<div class="container-fluid">
  <div class="row content">
    <div class="col-sm-3 sidenav">
      <h4> Blog</h4>
      <ul class="nav nav-pills nav-stacked">
        <li class="active"><a href="index.php">Home</a></li>
        <li><a href="createpost.php" role="button">New Post</a></li>
        <li><a  href="mypostsIndex.php"> My posts </a></li>
        
        <?php 
        //change login with logout if logged in 
        $now = time();
if (isset($_SESSION['discard_after']) && $now > $_SESSION['discard_after']) {
    // this session has worn out its welcome; kill it and start a brand new one
    session_unset();
    session_destroy();
    session_start();
}

// either new or old, it should live at most for another hour
$_SESSION['discard_after'] = $now + 3600;


        session_start();

         if(isset($_SESSION["loggedin"])) { ?>
          <li><a href="logout.php" id="logout" > Log out</a></li>
        <?php 
         } else{ ?>
           <li><a href="loginindex.php"> Login</a></li>
         <?php }  ?>
      </ul><br> 

      <a class="btn btn-primary " name="search" role="button" href="search.php">
           Search blog  <span class="glyphicon glyphicon-search"></span> 
          </a>
    </div>
</div>
</div>
    
     
 <!-- PHP list code  -->
<div id="posts1" class="container">
      
            <p><h4><small>NEW POST</small></h4></p>
      <hr>
      
      <?php

require_once "config.php";

// Define variables and initialize with empty values
$username = $title = $body = "";

    // Validate username  
   if(!isset($_SESSION["loggedin"]) ) {
      header("location: loginindex.php");    
}



if($_SERVER["REQUEST_METHOD"] == "POST"){
   
function test_input($data) {
  $data = trim($data);
  $data = strip_tags($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  $data = filter_var($data);
  return $data;
}

//use session variables 
if(isset($_POST["submit"])) {
   $title = test_input($_POST["title"]);
   $body = test_input($_POST["body"]);
   $username = test_input($_SESSION['username']);

      // Prepare an insert statement
        $sql = "INSERT INTO posts (username, title, body) VALUES (?, ?, ?);";
        //if($stmt = mysqli_query($connection, $sql)) {
       if($stmt = mysqli_prepare($connection, $sql)) {
        
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sss", $username, $title, $body);
             
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
            
                echo '<script> alert("Data saved."); </script>';

            } else{
                echo "Something went wrong. Please try again later.";
            } 
             }   
        // Close statement
        mysqli_stmt_close($stmt);
  }
}
      // Close connection
   mysqli_close($connection);

      ?> 
     


 <div class="wrapper">
        <h2>New Post</h2>
        
        <form action="" method="post">
            <div class="form-group ">
                <label>Title</label>
                <input type="text" name="title" class="form-control" >
                <span class="help-block"></span>
            </div>    
            <div class="form-group <">
                <label for="description">Body</label>
                <textarea rows="10" type="description" name="body" class="form-control" > 
                </textarea>
                <span class="help-block"></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" name="submit" value="Submit">
            </div>
            
        </form>
    </div>    
</div>

    <style>


body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }

    /* Set height of the grid so .sidenav can be 100% (adjust if needed) */
    #posts1 {
      left: 400px;
      width: 50%;

    }


    /* Set gray background color and 100% height */
    .sidenav {
      position: fixed;
      background-color: #f1f1f1;
      height: 100%;
    }
    
    /* Set black background color, white text and some padding */
    footer {
      background-color: #555;
      color: white;
      padding: 10px;
    }
    
    /* On small screens, set height to 'auto' for sidenav and grid */
    @media screen and (max-width: 767px) {
      .sidenav {
        height: auto;
        padding: 15px;
        position: relative;
      }
      .row.content {height: auto;} 
    
body{ font: 14px sans-serif;
    }
.container {
       padding-left: 10px;
    float: left;
    }

    }

   
   

  </style>
</body>
</html>