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
      </ul><br> 

    
    </div>
</div>
</div>
    
     
 <!-- PHP list code  -->
<div id="posts1" class="container">
      
            <p><h4><small>Log in</small></h4></p>
      <hr>
      
      <?php

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


//config
require_once "config.php";


//if loggedin direct to main page
if(isset($_session["loggedin"]) ) {
  header("location: index.php");
 
}

$username = $password = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
   
function test_input($data) {
  $data = trim($data);
  $data = strip_tags($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  $data = filter_var($data);
  return $data;
}

if(isset($_POST["login"])) { 
  $username = test_input($_POST["username"]);
  $password = test_input($_POST["passcode"]);
  
  $sql = "SELECT * FROM users WHERE username = '$username';";

    $result = mysqli_query($connection, $sql);

    if (mysqli_num_rows($result) > 0) {
    $userDetails = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $user = $userDetails["username"];   
    $param_hash = $userDetails["passcode"];

    if(password_verify($password, $param_hash)) {
      $_SESSION['loggedin'] = "true";
      $_SESSION['username'] = $username; 
            header("location: index.php");
    }
    else {}
    }
}
}
    mysqli_close($connection);

     ?> 
     


<div class="wrapper">
        <h2>Login</h2>
        <p>Please fill in the form to login.</p>
        <form action="#" method="post">
            <div class="form-group ">
                <label>Username</label>
                <input type="text" name="username" class="form-control">
               
            </div>    
            <div class="form-group <">
                <label>Password</label>
                <input type="password" name="passcode" class="form-control">
                <span class="help-block"></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" name="login" value="login">
            </div>
            <p>Don't have an account? <a href="registerindex.php">Sign up now</a>.</p>
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
    @media screen and (max-width: 600px) {
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