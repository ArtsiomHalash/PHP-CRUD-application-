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

<div id="posts1" class="container">
      
            <p><h4><small>UPDATE POST</small></h4></p>
      <hr>

<?php
$title = $body = $postid = $username = "";
require_once "config.php";

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


$postid = $_GET['postid'];
$username = $_SESSION['username'];

echo "$title" . "$body " . "$postid " . "$username" ;
    $sql = "SELECT * FROM posts WHERE post_id = '$postid';";
    
    $stmt = mysqli_query($connection, $sql);



     $postid = intval($postid);


if (isset($_POST['submit'])) {
$title = test_input($_POST["title"]);
$body  = test_input($_POST["body"]);

    $sql3 = "UPDATE posts SET title = '$title', body = '$body' WHERE post_id ='$postid' ;";

    $result = mysqli_query($connection, $sql3);
    if($result)
        {
            echo '<script> alert("Data Updated Successfully."); </script>';
           // header("Location:addnewpost.php");
        } 
}

if($stmt) {
  while ($row = mysqli_fetch_assoc($stmt)) {
?>


    <div class="wrapper">
        <h2>Update post</h2>
        
        <form action="" method="post">
            <div class="form-group" id="postid<?php echo $row['post_id'];?>">
                <label>Title</label>
                <input type="text" name="title" class="form-control" value="<?php echo $row["title"]; ?>">
                <span class="help-block"></span>
            </div>    
            <div class="form-group <">
                <label for="description">Body</label>
                <textarea rows="10" type="description" name="body" class="form-control"  > 
                    <?php echo $row["body"]; ?>
                </textarea>
                <span class="help-block"></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" name="submit" value="Submit">
            </div>
            
        </form>
    </div>   
</div>
<?php 
          
          }         
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
}
    // Close connection
    mysqli_close($connection);
             // echo "<p>Disconnected from server: " . $host . "</p>";

?>
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