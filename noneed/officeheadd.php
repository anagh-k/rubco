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


?>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
  * {
    box-sizing: border-box
  }

    {
    font-family: Arial, Helvetica, sans-serif;
  }

  h1 {
    width: 100%;
    background-color: #FF0000;
    text-align: center;
    color: white;

  }
</style>
<center>
  <div class="navbar">

    <h1>RUBCO GROUP OF UNDERTAKINGS<h1>

  </div>
  <h2>Wellcome to <?php echo $_SESSION['user']['username']; ?> Page</h2>


  <link rel="stylesheet" href="style.css" type="text/css" />

  <div id="profile">
    <h2>User name is: <?php echo $_SESSION['user']['username']; ?> and Your Role is :<?php echo $_SESSION['user']['role']; ?></h2>



    <!DOCTYPE html>
    <html>

    <head>
      <title>Table with database</title>
      <style>
        table {
          border-collapse: collapse;
          width: 70%;
          color: #588c7e;
          font-size: 15px;
          text-align: left;
        }

        th {
          background-color: #588c7e;
          color: white;
        }

        tr:nth-child(even) {
          background-color: #f2f2f2
        }
      </style>
    </head>

    <body>
      <table>
        <tr>
          <th>Id</th>
          <th>Item</th>
          <th>Size/Specifications</th>
          <th>Quantity</th>
          <th>Amount</th>





          <div id="logout"><a href="logout.php">Please Click To Logout</a></div>
</center>
</div>
<?php
// include "conn.php";
// include "session.php";
$conn = mysqli_connect("localhost", "root", "", "logindb");
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT id, item, Size_Specifications, Quantity, Amount  FROM form";
$result = $conn->query($sql);
//$row = mysqli_fetch_assoc($result);
// echo ($row["item"]);


if ($result) {
  if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
      echo "<tr><td>" . $row["id"] . "</td><td>" . $row["item"] . "</td><td>" . $row["Size_Specifications"] . "</td><td>" . $row["Quantity"] . "</td><td>"
        . $row["Amount"] . "</td></tr> ";
    }
  } else {
    echo "0 results";
  }
}
$conn->close();
?>


</table>
</body>

</html>