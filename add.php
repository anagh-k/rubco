<?php

session_start();







//Checking User Logged or Not
if (empty($_SESSION['user'])) {
    header('location:index.php');
}
//Restrict User or Moderator to Access Admin.php page
// if ($_SESSION['user']['role'] == 'officehead') {
//     header('location:officehead.php');
// }
// if ($_SESSION['user']['role'] == 'adminone') {
//     header('location:adminone.php');
// }
// if ($_SESSION['user']['role'] == 'admintwo') {
//     header('location:admintwo.php');
// }
// if ($_SESSION['user']['role'] == 'adminthree') {
//     header('location:adminthree.php');
// }


//72d38236dfd808eb6bbf
if (isset($_POST["submit"])) {
    $conn = mysqli_connect("localhost", "root", "", "logindb");
    $Nameofemployee = mysqli_real_escape_string($conn, $_POST['Nameofemployee']);
    $Designation = mysqli_real_escape_string($conn, $_POST['Designation']);
    $dateofjoining = mysqli_real_escape_string($conn, $_POST['dateofjoining']);
    $unit = mysqli_real_escape_string($conn, $_POST['unit']);
    $department = mysqli_real_escape_string($conn, $_POST['department']);
    $radio = mysqli_real_escape_string($conn, $_POST['radio']);
    $purposeofproduct = mysqli_real_escape_string($conn, $_POST['purposeofproduct']);
    $scaleofpay = mysqli_real_escape_string($conn, $_POST['Scaleofpay']);
    $unique = md5(uniqid(rand(), true));
    $result = mysqli_query($conn, "INSERT INTO `employee` VALUES ('', '$Nameofemployee', '$Designation','$scaleofpay', '$dateofjoining', '$unit', '$department', '$radio', '$purposeofproduct','$unique') ");
    $id = mysqli_query($conn, "SELECT empID FROM employee WHERE key_id  = '$unique' ");
    $id = mysqli_fetch_assoc($id);
    $id = $id['empID'];
    $table = $_POST['product'];
    if (count($table) == 1 && empty($table['0']['item'])) {
    } else {

        foreach ($table as $key => $val) {
            $item = mysqli_real_escape_string($conn, $val['item']);
            $size = mysqli_real_escape_string($conn, $val['size']);
            $quantity = mysqli_real_escape_string($conn, $val['quantity']);
            $amount = mysqli_real_escape_string($conn, $val['amount']);
            $result = mysqli_query($conn, "INSERT INTO `form` VALUES ('$id', '$item','$size', '$quantity', '$amount') ");
        }
    }
}
?>



<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="bootstrap.min.css" crossorigin="anonymous" />

    <style>
        .top {
            position: fixed;
            width: 100%;
            height: 10%;
            left: 0;
            right: 0;
            top: 0;
            z-index: 1;
        }

        .form {

            padding-top: 30;

        }



        input:focus {
            outline: none;
        }
    </style>
</head>

<body>

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
    </div>

    <div style="position: relative; margin-top: 7%; text-align: center;" class="h3">
        <span>
            <ins>
                APPLICATION FOR AVAILING RUBCO PRODUCTS AT CONCESSIONAL RATES
            </ins>
        </span>
    </div>
    <div class="text-center">
        <a class="btn btn-primary" href="clerk.php">
            View Data

        </a>
    </div>

    <form style="margin-left: 30; width: 100%;" action="add.php" method="post">
        <div class="form w-50 ">
            <div class="form-group  row p-2">
                <label for="Nameofemployee" class="col-sm-5 col-form-label ">Name of employee</label>
                <div class="col-sm-5">
                    <input type="input" class="form-control-plaintext border-dark border-top-0 " id="Nameofemployee" placeholder="Name of employee" name="Nameofemployee">
                </div>
            </div>

            <div class="form-group p-2 row">
                <label for="Designation" class="col-sm-5 col-form-label">Designation</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control-plaintext border-dark border-top-0" id="Designation" name="Designation" placeholder="Designation">
                </div>
            </div>

            <div class="form-group p-2 row">
                <label for="Scaleofpay" class="col-sm-5 col-form-label">Scale of pay</label>
                <div class="col-sm-5">
                    <input type="number" class="form-control-plaintext border-dark border-top-0" id="Scaleofpay" name="Scaleofpay" placeholder="Scale of pay">
                </div>
            </div>
            <div class="form-group p-2 row">
                <label for="dateofjoining" class="col-sm-5 col-form-label">Date of joining</label>
                <div class="col-sm-5">
                    <input type="date" class="form-control-d" id="dateofjoining" name="dateofjoining" placeholder="date of joining">
                </div>
            </div>
            <div class="form-group p-2 row">
                <label for="unit_company" class="col-sm-5 col-form-label">Uinit/Company</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control-plaintext border-dark border-top-0" id="unit_company" name="unit" placeholder="unit/company">
                </div>
            </div>
            <div class="form-group p-2 row">
                <label for="staticEmail" class="col-sm-5 col-form-label">Department</label>
                <div class="col-sm-5">
                    <input type="input" class="form-control-plaintext border-dark border-top-0" id="staticEmail" name="department" placeholder="department">
                </div>
            </div>

            <div class="form-group p-2 row">
                <label for="exampleRadios" class="col-sm-5 col-form-label">Credit required</label>
                <div class="col-sm-5 d-inline-flex">
                    <div class="col-sm-2">

                        <input class="form-check-input " type="radio" name="radio" id="yes" value="1">
                        <label class="form-check-label" for="yes">
                            Yes
                        </label>
                    </div>
                    <div class="col">

                        <input class="form-check-input " type="radio" name="radio" id="no" value="0" checked>
                        <label class="form-check-label " for="no">
                            No
                        </label>
                    </div>

                </div>
            </div>
            <div class="form-group p-2 row">
                <label for="purposeofproduct" class="col-sm-5 col-form-label">Actual purpose of products</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control-plaintext border-dark border-top-0" id="purposeofproduct" placeholder="purpose of product" name="purposeofproduct">
                </div>
            </div>

        </div>
        <div class="form-group text-center pt-3 h4">
            Add products
        </div>
        <!-- tablee -->
        <div class="row justify-content-center ">
            <div class="w-50">

                <table class="table table-striped table-warning align-content-center w-100" id="addProducts">
                    <thead>
                        <tr>
                            <th scope="col">Item</th>
                            <th scope="col">Size_Specifications</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Amount</th>
                        </tr>
                    </thead>
                    <tbody name="tbod">
                        <tr>
                            <td scope="row"><input class="form-control-plaintext border-secondary border-top-0" name="product[0][item]"></td>
                            <td scope="row"><input class="form-control-plaintext border-secondary border-top-0" name="product[0][size]"></td>
                            <td scope="row"><input class="form-control-plaintext border-secondary border-top-0" name="product[0][quantity]"></td>
                            <td scope="row"><input class="form-control-plaintext border-secondary border-top-0" name="product[0][amount]"></td>
                        </tr>
                    </tbody>
                </table>
                <div class="text-right">
                    <input type="button" class="btn btn-warning " value="Add more" onclick="add()">
                </div>
            </div>
        </div>




        <!-- table -->



        <div class="form-group text-center">
            <input style="margin-left:20;" class="btn btn-primary" type="submit" name="submit" value="Submit">
        </div>
    </form>

    </div>


    <script>
        var count = 1;

        function add() {
            var table = document.getElementById("addProducts");
            var len = table.rows[0].cells.length;
            var row = table.insertRow(1);
            var cell1 = row.insertCell(0);
            var cell2 = row.insertCell(1);
            var cell3 = row.insertCell(2);
            var cell4 = row.insertCell(3);
            cell1.innerHTML = "<input class='form-control-plaintext border-secondary border-top-0' name='product[" + count + "][item]'>";
            cell2.innerHTML = "<input class='form-control-plaintext border-secondary border-top-0' name='product[" + count + "][size]'>";
            cell3.innerHTML = "<input class='form-control-plaintext border-secondary border-top-0' name='product[" + count + "][quantity]'>";
            cell4.innerHTML = "<input class='form-control-plaintext border-secondary border-top-0' name='product[" + count + "][amount]'>";
            count++;
        }
    </script>

</body>

</html>