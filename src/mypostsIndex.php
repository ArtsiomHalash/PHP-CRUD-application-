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
        <li><a  href="#section1">My posts</a></li>
        
        <?php 
        //change login with logout if logged in 
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

    
 
     
 <div id="posts1" class="container">
            <h4><small>MY POSTS</small></h4>
      <hr>
      
       <?php

     session_start();
//echo $_SESSION['username'];
    // Include config file
    require_once "config.php";
    // Prepare a select statement
// choose the posts that are made by loggedin person
if(!isset($_SESSION["loggedin"]) ) {
      header("location: loginindex.php"); 

}
 
$username = $_SESSION['username'];


    $sql = "SELECT * FROM posts WHERE username = '$username';";
    
    $stmt = mysqli_query($connection, $sql);

//delete function
  if (isset($_GET["delete"])) {
  
    $postid = $_GET['postid'];

     $postid = intval($postid);
    
    $sql2 = "DELETE FROM posts WHERE username = '$username' AND post_id = $postid;";
    
    $result = mysqli_query($connection, $sql2);
  if ($result) {
    echo '<script> alert("Data Deleted."); </script>';
    header("location: mypostsIndex.php");
}
}

 if($stmt) {
  while ($row = mysqli_fetch_assoc($stmt)) {
     ?> 

                 
  
                  <div class="container">
                    <div class="form-group">
                        <label>
                        <p class="form-control-static"></p><?php echo $row['title']; ?>
                    </label>
                    </div>

                    <div class="form-group">
                        <p class="form-control-static">
                         <span class="glyphicon glyphicon-time"> </span>
                          <?php echo "Posted by: " . $row['username'] . ", " . $row['created_at'];?> 
                            </p>
                    </div>

                           <div class="container" >
                         
                           <div>
                        <button class="btn btn-info" data-toggle="collapse" data-target="#demo<?php echo $row['post_id']; ?>">Read more</button> 
                            </div> 

                        <div id="demo<?php echo $row['post_id'];?>" name="" class="collapse" > <?php echo $row['body']; ?>  
                        
                         <form action="" method="get">

                          <input type="text" hidden name="postid" value="<?php echo $row['post_id']; ?>">

                          <button type="submit" id="delete<?php echo $row['post_id'];?>" name="delete" class="btn btn-danger" value="<?php echo $row['post_id'];?>"> Delete 
                          </button> 
                         
                         
                          <span>
                              <button formaction="change.php" type="submit" id="change<?php echo $row['post_id'];?>" name="change" class="btn btn-warning" > Update
                               </button> 
                          </span>
                      </form>
                          
                         </div>
                     
                    </div>
        
                </div>
</div>

 <?php 
          
          }         
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }

    // Close connection
    mysqli_close($connection);
             // echo "<p>Disconnected from server: " . $host . "</p>";

?>


<style>

.container{
            width: 300px;
           padding: auto;
        }

    .sidenav {
      position: fixed;
      background-color: #f1f1f1;
      height: 100%;
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
   
    }

   
  </style>
</body>
</html>