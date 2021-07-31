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
if ($_SESSION['user']['role'] == 'clerk') {
    header('location:clerk.php');
}
if ($_SESSION['user']['role'] == 'adminone') {
    header('location:adminone.php');
}
if ($_SESSION['user']['role'] == 'adminthree') {
    header('location:adminthree.php');
}

$conn = mysqli_connect("localhost", "admin_2", "12345", "logindb");

if (isset($_POST) && $_SESSION['user']['role'] == 'admintwo') {
    foreach ($_POST as $key => $value) {
        $value = explode("_", $key)[0];
        $id = explode("_", $key)[1];
        $out = mysqli_query($conn, "UPDATE aproval SET admin_2=$value WHERE id =$id");
    }
}
$result = mysqli_query($conn, "SELECT * FROM form INNER JOIN aproval on form.id=aproval.id");

?>
<h1>Wellcome to <?php echo $_SESSION['user']['username']; ?> Page</h1>


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
                            <?php echo (($row["admin_1"] == 1) ? 'APPROVED' : (($row["admin_1"] == -1) ? 'REJECTED' : 'PENDING')) ?>
                        </th>
                        <th>
                            <form method="post" action="admintwo.php">
                                <div class="w3-section">
                                    <button name="1 <?php echo ($row["id"]) ?>" class="w3-button w3-green" <?php echo ($row["admin_2"] == 1) ? 'disabled' : '' ?>>APPROVE</button>
                                    <button name="-1 <?php echo ($row["id"]) ?>" class="w3-button w3-red" <?php echo ($row["admin_2"] == -1) ? 'disabled' : '' ?>>REJECT</button>
                                </div>
                            </form>
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