<?php
session_start();

//git updated



//Checking User Logged or Not
if (empty($_SESSION['user'])) {
    header('location:index.php');
}
//Restrict User or Moderator to Access Admin.php page
if ($_SESSION['user']['role'] == 'clerk') {
    header('location:clerk.php');
}
if ($_SESSION['user']['role'] == 'officehead') {
    header('location:officehead.php');
}
if ($_SESSION['user']['role'] == 'admintwo') {
    header('location:admintwo.php');
}
if ($_SESSION['user']['role'] == 'adminthree') {
    header('location:adminthree.php');
}

$conn = mysqli_connect("localhost", "admin_1", "12345", "logindb");

$result = mysqli_query($conn, "UPDATE aproval SET admin_1=1 WHERE id='19'");
$result = mysqli_query($conn, "SELECT * FROM aproval WHERE id=19");
$result = mysqli_fetch_assoc($result);
echo ($result["admin_1"]);



?>

<h1>Wellcome to <?php echo $_SESSION['user']['username']; ?> Page</h1>


<link rel="stylesheet" href="style.css" type="text/css" />
<div id="profile">
    <h2>User name is: <?php echo $_SESSION['user']['username']; ?> and Your Role is :<?php echo $_SESSION['user']['role']; ?></h2>
    <div id="logout"><a href="logout.php">Please Click To Logout</a></div>
</div>