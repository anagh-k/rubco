<?php
session_start();
//Checking User Logged or Not
if (empty($_SESSION['user'])) {
    header('location:index.php');
}
//Restrict User or Moderator to Access Admin.php page
if ($_SESSION['user']['role'] == 'clerk') {
    header('location:clerk.php');
}
if ($_SESSION['user']['role'] == 'adminone') {
    header('location:adminone.php');
}
if ($_SESSION['user']['role'] == 'admintwo') {
    header('location:admintwo.php');
}
if ($_SESSION['user']['role'] == 'adminthree') {
    header('location:adminthree.php');
}



//sql

$conn = mysqli_connect("localhost", "officehead", "12345", "logindb");

$result = mysqli_query($conn, "UPDATE aproval SET officehead=1 WHERE id='19'");
$result = mysqli_query($conn, "SELECT * FROM aproval WHERE id=19");
$result = mysqli_fetch_assoc($result);
echo ($result["officehead"]);


// Store the submitted data sent
// via POST method, stored 

// Temporarily in $_POST structure.
// $_SESSION['Name'] = $_GET['Name'];
// $_SESSION['Designation'] = $_GET['Designation'];
// $_SESSION['Unit'] = $_GET['Unit'];
// $_SESSION['Type in your products'] = $_GET['Type in your products'];
?>
<h1>Wellcome to <?php echo $_SESSION['user']['username']; ?> Page</h1>


<link rel="stylesheet" href="style.css" type="text/css" />
<div id="profile">
    <h2>User name is: <?php echo $_SESSION['user']['username']; ?> and Your Role is :<?php echo $_SESSION['user']['role']; ?></h2>
    <div id="logout"><a href="logout.php">Please Click To Logout</a></div>
</div>