<!DOCTYPE html>
<html>
<head>
	<title>log out</title>
</head>
<body>

<?php 
// Initialize the session
session_start();
 
// Unset all of the session variables
$_SESSION = array();
 
// Destroy the session.
session_destroy();
 
// Redirect to login page
header("location: loginindex.php");
exit;

?>

</body>
</html>