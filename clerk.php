<?php
session_start();






//Checking User Logged or Not
if (empty($_SESSION['user'])) {
  header('location:index.php');
}
//Restrict User or Moderator to Access Admin.php page
if ($_SESSION['user']['role'] == 'officehead') {
  header('location:officehead.php');
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




$conn = mysqli_connect('localhost', 'clerk', '12345', 'logindb');

if (isset($_POST['send'])) {
  $Item = mysqli_real_escape_string($conn, $_POST['Item']);
  $Size_Specification = mysqli_real_escape_string($conn, $_POST['Size_Specification']);
  $Quantity = mysqli_real_escape_string($conn, $_POST['Quantity']);
  $Amount = mysqli_real_escape_string($conn, $_POST['Amount']);
  if (empty($Item) or empty($Size_Specification) or empty($Quantity) or empty($Amount)) {
    $error = 'Fileds are Mandatory';
    echo ($error);
  } else {
    $result = mysqli_query($conn, "INSERT INTO `form` (`Item`, `Size_Specifications`, `Quantity`, `Amount`) VALUES ('$Item', '$Size_Specification', '$Quantity', '$Amount')");
  }
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

  a {}
</style>


<div class="navbar">

  <h1>Rubco<h1>

</div>

<body>
  <center>
    <h2>Wellcome to <?php echo $_SESSION['user']['username']; ?> Page</h2>


    <link rel="stylesheet" href="style.css" type="text/css" />
    <div id="profile">
      <h2>User name is: <?php echo $_SESSION['user']['username']; ?> and Your Role is :<?php echo $_SESSION['user']['role']; ?></h2>
  </center>
  <!DOCTYPE html>
  <html>

  <body>

    <center>
      <h2>Amount Adding Form</h2>
    </center>



    <form action="" method="POST">
      <div class="container" style="background-color:#f1f1f1">
        <center><label for="Item">Item:</label>
          <input type="text" id="Item" name="Item" value=""><br>
          <label for="Size_Specification">Size_Specification:</label>
          <input type="text" id="Size_Specification" name="Size_Specification" value=""><br>
          <label for="Quantity">Quantity:</label>
          <input type="text" id="Quantity" name="Quantity" value=""><br><br>

          <label for="Amount list">Type in your Amounts:</label><br>
          <textarea id="w3review" name="Amount" rows="20" cols="50">


  </textarea><br>
          <input color:green type="submit" value="Submit" name="send">
        </center>
    </form>

    <center>
      <p>If you click the "Submit" button, the form will be sent to a officehead.</p>
    </center>

  </body>

  </html>
  <div id="logout"><a href="logout.php">Please Click To Logout </div>
  </div>