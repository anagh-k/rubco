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


    <!--  -->


    <?php

    $result = mysqli_query($conn, "SELECT * FROM form INNER JOIN aproval on form.id=aproval.id");

    ?>
    <h1>Wellcome to <?php echo $_SESSION['user']['username']; ?> Page</h1>


    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <div id="profile">

      <style>
        table.redTable {
          font-family: "Trebuchet MS", Helvetica, sans-serif;
          border: 2px solid #A40808;
          background-color: #EEE7DB;
          width: 100%;
          text-align: center;
          border-collapse: collapse;
        }

        table.redTable td,
        table.redTable th {
          border: 1px solid #AAAAAA;
          padding: 5px 2px;
        }

        table.redTable tbody td {
          font-size: 13px;
        }

        table.redTable tr:nth-child(even) {
          background: #F5C8BF;
        }

        table.redTable thead {
          background: #A40808;
        }

        table.redTable thead th {
          font-size: 19px;
          font-weight: bold;
          color: #FFFFFF;
          text-align: center;
          border-left: 2px solid #A40808;
        }

        table.redTable thead th:first-child {
          border-left: none;
        }

        table.redTable tfoot {
          font-size: 13px;
          font-weight: bold;
          color: #FFFFFF;
          background: #A40808;
        }

        table.redTable tfoot td {
          font-size: 13px;
        }

        table.redTable tfoot .links {
          text-align: right;
        }

        table.redTable tfoot .links a {
          display: inline-block;
          background: #FFFFFF;
          color: #A40808;
          padding: 2px 8px;
          border-radius: 5px;
        }
      </style>

      <div style="padding: 20;">

        <table class="redTable" style="height: 110px;" width="519">
          <thead>
            <tr>
              <th>ID</th>
              <th>Size_Specifications</th>
              <th>Item</th>
              <th>Quantity</th>
              <th>Amount</th>
              <th>officehead</th>
              <th>admin_3</th>
              <th>admin_2</th>
              <th>admin_1</th>
            </tr>
          </thead>
          <tbody>
            <?php
            while ($row = mysqli_fetch_array($result)) {
            ?>

              <tr>
                <th><?php echo $row["id"] ?></th>
                <th><?php echo $row["Item"] ?></th>
                <th><?php echo $row["Size_Specifications"] ?></th>
                <th><?php echo $row["Quantity"] ?></th>
                <th><?php echo $row["Amount"] ?></th>
                <th bgcolor="<?php echo (($row["officehead"] == 1) ? 'green' : (($row["officehead"] == -1) ? 'red' : 'white')) ?>"><?php echo (($row["officehead"] == 1) ? 'APPROVED' : (($row["officehead"] == -1) ? 'REJECTED' : 'PENDING')) ?></th>
                <th bgcolor="<?php echo (($row["admin_3"] == 1) ? 'green' : (($row["admin_3"] == -1) ? 'red' : 'white')) ?>"><?php echo (($row["admin_3"] == 1) ? 'APPROVED' : (($row["admin_3"] == -1) ? 'REJECTED' : 'PENDING')) ?></th>
                <th bgcolor="<?php echo (($row["admin_2"] == 1) ? 'green' : (($row["admin_2"] == -1) ? 'red' : 'white')) ?>"><?php echo (($row["admin_2"] == 1) ? 'APPROVED' : (($row["admin_2"] == -1) ? 'REJECTED' : 'PENDING')) ?></th>
                <th bgcolor="<?php echo (($row["admin_1"] == 1) ? 'green' : (($row["admin_1"] == -1) ? 'red' : 'white')) ?>">
                  <?php echo (($row["admin_1"] == 1) ? 'APPROVED' : (($row["admin_1"] == -1) ? 'REJECTED' : 'PENDING')) ?></th>
              </tr>
              </tr>
            <?php } ?>
          </tbody>
        </table>




        <table class="tg">
          <thead>
          </thead>
        </table>

      </div>

    </div>



    <!--  -->








  </body>

  </html>
  <div id="logout"><a href="logout.php">Please Click To Logout </div>
  </div>