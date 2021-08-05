<?php

session_start();


$id = $_GET['id'];
$conn = mysqli_connect("localhost", "root", "", "logindb");
$employee = mysqli_query($conn, "SELECT * FROM employee INNER JOIN aproval on employee.empID=aproval.empID");
$products = mysqli_query($conn, "SELECT * FROM  `form` WHERE empID=$id");
$employee = mysqli_fetch_assoc($employee);

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
            margin: auto;

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
        </nav>
    </div>

    <div style="position: relative; margin-top: 7%; text-align: center;" class="h3">
        <span>
            <ins>
                APPLICATION FOR AVAILING RUBCO PRODUCTS AT CONCESSIONAL RATES
            </ins>
        </span>
    </div>

    <form style="margin-left: 30; width: 100%;" action="add.php" method="post">
        <div class="form w-50 ">
            <div class="form-group  row p-2">
                <label for="Nameofemployee" class="col-sm-5 col-form-label ">Name of employee</label>
                <div class="col-sm-5">
                    <input type="input" class="form-control-plaintext border-dark border-top-0 " id="Nameofemployee" placeholder="Name of employee" name="Nameofemployee" readonly value="<?php echo $employee['employeeName'] ?>">
                </div>
            </div>

            <div class="form-group p-2 row">
                <label for="Designation" class="col-sm-5 col-form-label">Designation</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control-plaintext border-dark border-top-0" id="Designation" name="Designation" placeholder="Designation" readonly value="<?php echo $employee['designation'] ?>">
                </div>
            </div>

            <div class=" form-group p-2 row">
                <label for="Scaleofpay" class="col-sm-5 col-form-label">Scale of pay</label>
                <div class="col-sm-5">
                    <input type="number" class="form-control-plaintext border-dark border-top-0" id="Scaleofpay" name="Scaleofpay" placeholder="Scale of pay" readonly value="<?php echo $employee['scaleofpay'] ?>">
                </div>
            </div>
            <div class=" form-group p-2 row">
                <label for="dateofjoining" class="col-sm-5 col-form-label">Date of joining</label>
                <div class="col-sm-5">
                    <input type="date" class="form-control-d" id="dateofjoining" name="dateofjoining" placeholder="date of joining" readonly value="<?php echo $employee['dateofjoining'] ?>">
                </div>
            </div>
            <div class=" form-group p-2 row">
                <label for="unit_company" class="col-sm-5 col-form-label">Uinit/Company</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control-plaintext border-dark border-top-0" id="unit_company" name="unit" placeholder="unit/company" readonly value="<?php echo $employee['unit'] ?>">
                </div>
            </div>
            <div class=" form-group p-2 row">
                <label for="staticEmail" class="col-sm-5 col-form-label">Department</label>
                <div class="col-sm-5">
                    <input type="input" class="form-control-plaintext border-dark border-top-0" id="staticEmail" name="department" placeholder="department" readonly value="<?php echo $employee['department'] ?>">
                </div>
            </div>

            <div class=" form-group p-2 row">
                <label for="exampleRadios" class="col-sm-5 col-form-label">Credit required</label>
                <div class="col-sm-5">
                    <input type="input" class="form-control-plaintext border-dark border-top-0" id="staticEmail" name="department" placeholder="department" readonly value="<?php echo ($employee['credit']) ? "Yes" : "No" ?>">
                </div>
            </div>
            <div class="form-group p-2 row">
                <label for="purposeofproduct" class="col-sm-5 col-form-label">Actual purpose of products</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control-plaintext border-dark border-top-0" id="purposeofproduct" placeholder="purpose of product" name="purposeofproduct" readonly value="<?php echo $employee['purpose'] ?>">
                </div>
            </div>

        </div>
        <div class=" form-group text-center pt-3 h4">
            Products
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
                        <?php
                        while ($row = mysqli_fetch_array($products)) {


                        ?>
                            <tr>
                                <td scope="row"><input readonly class="form-control-plaintext border-secondary border-top-0" value="<?php echo $row['Item'] ?>"></td>
                                <td scope="row"><input readonly class="form-control-plaintext border-secondary border-top-0" value="<?php echo ($row['Size_Specifications']) ?>"></td>
                                <td scope="row"><input readonly class="form-control-plaintext border-secondary border-top-0" value="<?php echo ($row['Quantity']) ?>"></td>
                                <td scope="row"><input readonly class="form-control-plaintext border-secondary border-top-0" value="<?php echo ($row['Amount']) ?>"></td>

                            </tr>
                        <?php } ?>
                    </tbody>
                </table>

                <table class="table table-striped table-warning align-content-center w-100 p-5">
                    <thead>

                        <tr>
                            <th scope="col" class="col-1"><?php echo $_SESSION['user']['users']['1'] ?></th>
                            <th scope="col" class="col-1"><?php echo $_SESSION['user']['users']['4'] ?></th>
                            <th scope="col" class="col-1"><?php echo $_SESSION['user']['users']['3'] ?></th>
                            <th scope="col" class="col-1"><?php echo $_SESSION['user']['users']['2'] ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?php echo (($employee[$_SESSION['user']['users']['1']] == 1) ? 'APPROVED' : (($employee[$_SESSION['user']['users']['1']] == -1) ? 'REJECTED' : 'PENDING')) ?></td>
                            <td><?php echo (($employee[$_SESSION['user']['users']['4']] == 1) ? 'APPROVED' : (($employee[$_SESSION['user']['users']['4']] == -1) ? 'REJECTED' : 'PENDING')) ?></td>
                            <td><?php echo (($employee[$_SESSION['user']['users']['3']] == 1) ? 'APPROVED' : (($employee[$_SESSION['user']['users']['3']] == -1) ? 'REJECTED' : 'PENDING')) ?></td>
                            <td><?php echo (($employee[$_SESSION['user']['users']['2']] == 1) ? 'APPROVED' : (($employee[$_SESSION['user']['users']['2']] == -1) ? 'REJECTED' : 'PENDING')) ?></td>
                        </tr>
                    </tbody>

                </table>
            </div>
        </div>




        <!-- table -->



        <div class="form-group text-center">
            <input style="margin-left:20;" class="btn btn-primary" type="button" name="print" value="print" onclick="window.print()">
        </div>
    </form>

    </div>


</body>

</html>