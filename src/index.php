<!DOCTYPE html>
<html lang="en">
<head>

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
?>
  
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
        <li class="active"><a href="#section1">Home</a></li>
        <li><a href="createpost.php" role="button">New Post</a></li>
        <li><a  href="mypostsIndex.php"> My posts </a></li>
        
        <?php 

        //change login with logout if logged in 
         if(isset($_SESSION["loggedin"])) { ?>
          <li><a href="logout.php" id="logout" > Log out</a></li>
        <?php 
         } else{ ?>
           <li><a href="loginindex.php"> Login</a></li>
         <?php }  ?>
      
      </ul><br> 
       <hr class="my-4">
        
          <a class="btn btn-primary " name="search" role="button" href="search.php">
           Search blog  <span class="glyphicon glyphicon-search"></span> 
          </a>
    
    </div>
  </div>
</div>

 <!-- PHP list code  -->
<div id="posts1" class="container">
      
            <p><h4><small>RECENT POSTS</small></h4></p>
      <hr>
      
      <?php

     require_once "config.php";

    // Prepare a select statement
    $sql = "SELECT * FROM posts;";
    
    $stmt = mysqli_query($connection, $sql);

           if($stmt) {
            while ($row = mysqli_fetch_assoc($stmt)) {
             
    
?>
  
</div>
  
              <div class="container">
                    <div class="form-group">
                        <label>
                        <p class="form-control-static"><?php echo $row["title"]; ?></p>
                      </label>
                    </div>

                    <div class="form-group">
                     
                        <p class="form-control-static">
                         <span class="glyphicon glyphicon-time"> </span>
                          <?php echo "Posted by: " . $row['username'] . ", " . $row['created_at'];?>  
                           </p>
                      
                           <div class="container">
                           <div>
                        <button class="btn btn-info" data-toggle="collapse" data-target="#demo<?php echo $row['post_id']; ?>"> Read more
                        </button>
                            </div>
                        <p class="text-justify">
                          <div id="demo<?php echo $row['post_id']; ?>" class="collapse" > <?php echo $row["body"]; ?>  
                         </div>
                       </p>
                    </div>
                </div>
            </div>        
        
  
 <?php 
          
          }         
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
     
    // Close statement
    //mysqli_stmt_close($stmt);
    
    // Close connection
    mysqli_close($connection);
            //  echo "<p>Disconnected from server: " . $host . "</p>";
?>



    <style>

a {
  sty
}

.container{
            width: 300px;
           padding: auto;
        }

    /* Set height of the grid so .sidenav can be 100% (adjust if needed) */


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



    }

   
   

  </style>
</body>
</html>