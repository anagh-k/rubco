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

<html>



<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="bootstrap.min.css" crossorigin="anonymous" />

  <style>
    /* .top {
      text-align: center;
      position: fixed !important;
      width: 100%;
      z-index: 1;

    }

    .topfixed {
      overflow: auto;
      height: 170;
    }

    thead {
      position: sticky;
      top: 140;
      z-index: 1;
    } */




    .flex-center {
      position: fixed;
      width: 100%;
      height: 10%;
      left: 0;
      right: 0;
      top: 0;
      z-index: 1;
    }

    thead {
      position: sticky;
      width: 100%;
      left: 0;
      right: 0;
      top: 25%;
      z-index: 1;
    }

    .add {
      position: fixed;
      background-color: white;
      width: 100%;
      height: 20%;
      padding: 10;
    }

    .tableClass {
      padding: 20;
      margin-top: 20;
      position: relative;
      top: 20%;
      width: 100%;
      height: 100%;
    }
  </style>

</head>

<body>




  <div class="flex-center">

    <div class="top">

      <nav class="navbar navbar-dark bg-dark navbar-fixed-top" style="height:70; align-content: center">
        <a class="navbar-brand">
          <img src="rubco.jpg" height="50" class="d-inline-block align-center" alt="" style="padding-bottom: 10" />
          <span class="navbar-text navbar-light h1" style="color: white">
            Rubco
          </span></a>
        <form class="form-inline align-top" style="padding-top: 10" action="logout.php">

          <div class="d-flex flex-column bd-highlight mb-0" style="padding-right: 50; color: white">
            <div class="p-2 bd-highlight" style="height: 30">USER: <?php echo $_SESSION['user']['username']; ?></div>
            <div class="p-2 bd-highlight">ROLE: <?php echo $_SESSION['user']['role']; ?></div>
          </div>

          <button class="btn btn-outline-danger my-2 my-sm-0 padd" type="Logout">
            Logout
          </button>
        </form>
      </nav>






      <?php

      $result = mysqli_query($conn, "SELECT * FROM form INNER JOIN aproval on form.id=aproval.id");

      ?>




      <div class="add">
        <tr>
          <form class="form-inline p-3" method="POST">
            <td> <input class="form-control m-2" type="text" id="Item" name="Item" placeholder="Item"></td>
            <td> <input class="form-control m-2" type="text" id="Size_Specification" name="Size_Specification" placeholder="Size_specifications"></td>
            <td> <input class="form-control m-2" type="text" id="Quantity" name="Quantity" placeholder="Quantity"></td>
            <td> <input class="form-control m-2" type="text" id="Amount" name="Amount" placeholder="Amount"></td>
            <td> <button type="submit" class="btn btn-primary m-2" name="send">Add New</button></td>
          </form>
        </tr>
      </div>

    </div>
  </div>

  <div class="tableClass">

    <table class="table table-striped table-warning table-hover " style="word-break: break-all;">
      <thead class="bg-warning">
        <tr class="table-active">
          <th scope="col">ID</th>
          <th scope="col">Item</th>
          <th scope="col">Size_Specifications</th>
          <th scope="col">Quantity</th>
          <th scope="col">Amount</th>
          <th scope="col">officehead</th>
          <th scope="col">admin_3</th>
          <th scope="col">admin_2</th>
          <th scope="col">admin_1</th>
        </tr>
      </thead>
      <tbody>


        <?php
        while ($row = mysqli_fetch_array($result)) {
        ?>

          <tr>
            <td scope="row"><?php echo $row["id"] ?></th>
            <td><?php echo $row["Item"] ?></th>
            <td><?php echo $row["Size_Specifications"] ?></th>
            <td><?php echo $row["Quantity"] ?></th>
            <td><?php echo $row["Amount"] ?></th>
            <td class="bg-<?php echo (($row["officehead"] == 1) ? 'success' : (($row["officehead"] == -1) ? 'danger' : 'light')) ?>"><?php echo (($row["officehead"] == 1) ? 'APPROVED' : (($row["officehead"] == -1) ? 'REJECTED' : 'PENDING')) ?></th>
            <td class="bg-<?php echo (($row["admin_3"] == 1) ? 'success' : (($row["admin_3"] == -1) ? 'danger' : 'light')) ?>"><?php echo (($row["admin_3"] == 1) ? 'APPROVED' : (($row["admin_3"] == -1) ? 'REJECTED' : 'PENDING')) ?></th>
            <td class="bg-<?php echo (($row["admin_2"] == 1) ? 'success' : (($row["admin_2"] == -1) ? 'danger' : 'light')) ?>"><?php echo (($row["admin_2"] == 1) ? 'APPROVED' : (($row["admin_2"] == -1) ? 'REJECTED' : 'PENDING')) ?></th>
            <td class="bg-<?php echo (($row["admin_1"] == 1) ? 'success' : (($row["admin_1"] == -1) ? 'danger' : 'light')) ?>">
              <?php echo (($row["admin_1"] == 1) ? 'APPROVED' : (($row["admin_1"] == -1) ? 'REJECTED' : 'PENDING')) ?></th>
          </tr>
        <?php } ?>
      </tbody>
    </table>


    <thead>
    </thead>
    </table>

  </div>

</body>

</html>