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
        <li><a  href="mypostsIndex.php">My posts</a></li>
      </ul><br> 

      
</div>
</div>

    
 
     <div id="posts1" class="container">
            <h4><small>Register</small></h4>
      <hr>
      
       <?php

     require "config.php";

//initialize variables 
$username = $password  ="";


   if($_SERVER["REQUEST_METHOD"] == "POST"){
   
function test_input($data) {
  $data = trim($data);
  $data = strip_tags($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  $data = filter_var($data);
  return $data;
}

   $username = test_input($_POST["username"]);
   $password = test_input($_POST["passcode"]);

    if (strlen($password) < 8) {
        echo "Password too short!";

    } elseif  (!preg_match("#[0-9]+#", $password)) {
        echo "Password must include at least one number!";
  
   } elseif  (!preg_match("#[a-zA-ZA-z]+#", $password)) {
       echo "Password must include at least one uppercase letter!";
    }     else {  }
 

//check if username exists
   $sql_u = "SELECT id FROM users WHERE username=?;";
  
   $res_u = mysqli_query($connection, $sql_u);
  
  if ($res_u) {
 if ( mysqli_num_rows($res_u) > 0) {
     echo "Sorry... username already taken";
 }
  }  

  // Check input errors before inserting in database  
    if(!empty($username) && !empty($password)){
      
        // Prepare an insert statement
        $sql = "INSERT INTO users (username, passcode) VALUES (?, ?);";
       

        if($stmt = mysqli_prepare($connection, $sql)){
           
            // Set parameter
            $param_password = password_hash($password, PASSWORD_DEFAULT); 
            // Creates a password hash
            // store password and hash sapperately?
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $username, $param_password);
          
        
            //  execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
               
                // Redirect to login page
               header("location: loginindex.php");
    } else{
                echo "Something went wrong. Please try again later.";
                echo "Or username already taken.";
           }
             
            // Close statement
            mysqli_stmt_close($stmt);
        }
} else {

 echo "Enter username and password.";
    
    }
  }
    mysqli_close($connection);

     ?> 

      

    <div class="overlay">
        <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>
       <form action="" method="post">
       
            <div class="form-group ">
                <label>Username</label>
                <input type="text" name="username" class="form-control"> 
                <span class="help-block"></span>
            </div>   

            <div class="form-group ">
                <label>Password</label>
                
                <input type="password" name="passcode" class="form-control">
                <span class="help-block">your password must contain: <br>
                                           At least one uppercase letter, <br>
                                           at least one number <br>
                                           and be atleast 8 charachters long.
                </span>
                
            <div class="form-group">
                <input type="submit" class="btn btn-primary" name="submit" value="Submit">
                <!-- <input type="reset" class="btn btn-default" value="Reset"> -->
            </div>
            <p>Already have an account? <a href="loginindex.php">Login here</a>.</p>
        </form>

       
 </div>

</div>


<style>

.center {
    margin: 0 auto;
    width: 80%;
}

body{ font: 14px sans-serif; }
        .overlay{ width: 350px; }
        #pas {
            color: lightgray;
            font-size: 10px;
            font-family:  "Courier New", monospace;
        }
        #pas:hover {
            color: black;
        }

    /* Set height of the grid so .sidenav can be 100% (adjust if needed) */
    #posts1 {
      left: 400px;
      width: 50%;

    }


    #posts2{
      left: 330px;
      
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
      padding: 15px;
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