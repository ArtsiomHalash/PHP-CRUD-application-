
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
       <div class="input-group">
    <form action="" method="get">
     
        <input type="text" name="input" id="input" class="form-control" placeholder="Search Blog..">
       <!-- <span class="input-group-btn"> -->
          <button class="btn btn-default" name="search" type="submit">
            <span class="glyphicon glyphicon-search"></span>
          </button>         
               
      
    </form>
    </div>
   </div>
 </div>
</div>

    <!--
      <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script type="text/javascript">

      $(document).ready(function(){
    $('.input-group input[type="text"]').on("keyup input", function(){
        /* Get input value on change */
        var inputVal = $(this).val();
        var resultDropdown = $(this).siblings(".result");
        if(inputVal.length){
            $.get("backend-search.php", {term: inputVal}).done(function(data){
                // Display the returned data in browser
                resultDropdown.html(data);
            });
        } else{
            resultDropdown.empty();
        }
    });
    
    // Set search input value on click of result item
    $(document).on("click", ".result p", function(){
        $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
        $(this).parent(".result").empty();
    });
});

    </script>
     -->

 <!-- PHP list code  -->
<div id="posts1" class="container">
      
            <p><h4><small>SEARCH RESULTS</small></h4></p>
      <hr>
<?php

require_once "config.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){
   
function test_input($data) {
  $data = trim($data);
  $data = strip_tags($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  $data = filter_var($data);
  return $data;
}

if (isset($_GET["search"])) {
            echo "string";

 $input = trim(test_input($_GET["input"]));
 //$post_time = trim($_GET["created_at"]);
 // Only add the filter if a name has been searched for.
   if (empty($input)) {
    echo "Search field is empty";
   // $filter = " WHERE title LIKE '%" . $input . "%'";
 } else {

$query = "SELECT * FROM users  ;";
//WHERE title LIKE '%$input%' OR body LIKE '%$input%'
  $result = mysqli_query($connection, $query);
  
   if ($result == false) { // If database query failed - Search query failed
     
       echo "<p>Search query failed </p>";
   
    } else { // If database query was successful
 
  //$numOfResults = mysqli_num_rows($result);

 //echo "<h1>Users</h1>";
   //echo "<h2>" . $numOfResults . " results found</h2>";
     //echo "<ul>";
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
          
?>

              <div class="container">
                <form action="" method="post">
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

                          <input type="text" hidden name="postid" value="<?php echo $row['post_id']; ?>">
                        </div>
                      </div>
                      </form> 
                         </div> 
                    </div>
              
              


<?php
}
}
}
mysqli_close($connection);
}
}
?>

    <style>

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