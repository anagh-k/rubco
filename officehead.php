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

$result = mysqli_query($conn, "SELECT * FROM form INNER JOIN aproval on form.id=aproval.id");
//$result = mysqli_fetch_assoc($result);



// Store the submitted data sent
// via POST method, stored 

// Temporarily in $_POST structure.
// $_SESSION['Name'] = $_GET['Name'];
// $_SESSION['Designation'] = $_GET['Designation'];
// $_SESSION['Unit'] = $_GET['Unit'];
// $_SESSION['Type in your products'] = $_GET['Type in your products'];
?>
<h1>Wellcome to <?php echo $_SESSION['user']['username']; ?> Page</h1>


<!-- <link rel="stylesheet" href="style.css" type="text/css" /> -->
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<div id="profile">
    <h2>User name is: <?php echo $_SESSION['user']['username']; ?> and Your Role is :<?php echo $_SESSION['user']['role']; ?></h2>
    <div id="logout"><a href="logout.php">Please Click To Logout</a></div>

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
                    <th>APPROVE / REJECT</th>
                </tr>
            </thead>
            <!-- <tfoot>
            <tr>
                <td colspan="10">
                    <div class="links"><a href="#">&laquo;</a> <a class="active" href="#">1</a> <a href="#">2</a> <a href="#">3</a> <a href="#">4</a> <a href="#">&raquo;</a></div>
                </td>
            </tr>
        </tfoot> -->
            <tbody>
                <?php

                while ($row = mysqli_fetch_array($result)) {



                ?>
                    <!-- <tr>
                    <td>cell1_1</td>
                    <td>cell2_1</td>
                    <td>cell3_1</td>
                    <td>cell4_1</td>
                    <td>sasdsdsasadasd</td>
                    <td>cell6_1</td>
                    <td>cell7_1</td>
                    <td>cell8_1</td>
                    <td>cell8_1</td> -->
                    <tr>
                        <th><?php echo $row["id"] ?></th>
                        <th><?php echo $row["Item"] ?></th>
                        <th><?php echo $row["Size_Specifications"] ?></th>
                        <th><?php echo $row["Quantity"] ?></th>
                        <th><?php echo $row["Amount"] ?></th>
                        <th><?php echo $row["officehead"] ?></th>
                        <th><?php echo $row["admin_3"] ?></th>
                        <th><?php echo $row["admin_2"] ?></th>
                        <th><?php echo $row["admin_1"] ?></th>
                        <th>
                            <div class="w3-section">
                                <button class="w3-button w3-green">APPROVE</button>
                                <button class="w3-button w3-red">REJECT</button>
                            </div>
                        </th>
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