<?php
session_start();
//Checking User Logged or Not
if (empty($_SESSION['user'])) {
    header('location:index.php');
}
// //Restrict User or Moderator to Access Admin.php page
if ($_SESSION['user']['role'] == 'clerk') {
    header('location:add.php');
}
// if ($_SESSION['user']['role'] == 'officehead') {
//     header('location:officehead.php');
// }
// if ($_SESSION['user']['role'] == 'adminone') {
//     header('location:adminone.php');
// }
// if ($_SESSION['user']['role'] == 'admintwo') {
//     header('location:admintwo.php');
// }
$user = $_SESSION['user']['role'];
echo $user;
$conn = mysqli_connect("localhost", "root", "", "logindb");

$id = 0;
if (isset($_POST) && $_SESSION['user']['role'] == $user) {
    foreach ($_POST as $key => $value) {
        $value = explode("_", $key)[0];
        $id = explode("_", $key)[1];
        $out = mysqli_query($conn, "UPDATE aproval SET $user=$value WHERE empID=$id");
    }
}
$result = mysqli_query($conn, "SELECT * FROM employee INNER JOIN aproval on employee.empID=aproval.empID");


?>
<html>

<head>
    <Script>
        function pop_up(url) {
            window.open(url, 'win2', 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=1076,height=768,directories=no,location=no')
        }
    </script>
    <script>
        try {

            document.addEventListener("DOMContentLoaded", function() {
                document.getElementById("<?php echo ($id) ?>").scrollIntoView({
                    block: "center"
                });
            });
        } catch {}
    </script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="bootstrap.min.css" crossorigin="anonymous" />
    <style>
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
            top: 10%;
            z-index: 1;
        }

        .tableClass {
            position: relative;
            top: 10%;
            width: 100%;
            height: 100%;
        }
    </style>

</head>

<body>
    <div>

        <div class="flex-center">

            <nav class="navbar navbar-dark bg-dark" style="height:70; align-content: center">
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
    </div>

    <div class="tableClass" style="padding: 20">

        <table class="table table-striped table-warning table-hover table-sm table-borderd" style="word-break: break-all">
            <thead class="bg-warning">
                <tr class="table-active">
                    <th scope="col">ID</th>
                    <th scope="col">Employee Name</th>
                    <th scope="col" class="col-1">officehead</th>
                    <th scope="col" class="col-1">adminthree</th>
                    <th scope="col" class="col-1">admintwo</th>
                    <th scope="col" class="col-1">adminone</th>
                    <th scope="col" class="col-2">APPROVE / REJECT</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_array($result)) {
                ?>

                    <tr>
                        <td scope="row" id="<?php echo $row["empID"] ?>"><?php echo $row["empID"] ?></th>
                        <td onclick="pop_up('view.php?id=<?php echo $row['empID'] ?>')">
                            <?php echo ($row['employeeName']) ?>
                            </th>
                        <td class="text-center bg-<?php echo (($row["officehead"] == 1) ? 'success' : (($row["officehead"] == -1) ? 'danger' : 'light')) ?>"><?php echo (($row["officehead"] == 1) ? 'APPROVED' : (($row["officehead"] == -1) ? 'REJECTED' : 'PENDING')) ?></th>
                        <td class="text-center bg-<?php echo (($row["adminthree"] == 1) ? 'success' : (($row["adminthree"] == -1) ? 'danger' : 'light')) ?>"><?php echo (($row["adminthree"] == 1) ? 'APPROVED' : (($row["adminthree"] == -1) ? 'REJECTED' : 'PENDING')) ?></th>
                        <td class="text-center bg-<?php echo (($row["admintwo"] == 1) ? 'success' : (($row["admintwo"] == -1) ? 'danger' : 'light')) ?>"><?php echo (($row["admintwo"] == 1) ? 'APPROVED' : (($row["admintwo"] == -1) ? 'REJECTED' : 'PENDING')) ?></th>
                        <td class="text-center bg-<?php echo (($row["adminone"] == 1) ? 'success' : (($row["adminone"] == -1) ? 'danger' : 'light')) ?>">
                            <?php echo (($row["adminone"] == 1) ? 'APPROVED' : (($row["adminone"] == -1) ? 'REJECTED' : 'PENDING')) ?></th>
                        <td>
                            <form method="post" action="data.php">
                                <div>
                                    <button class="btn btn-success" name="1 <?php echo ($row["empID"]) ?>" class="w3-button w3-green" <?php echo ($row[$user] == 1) ? 'disabled' : '' ?>>APPROVE</button>
                                    <button class="btn btn-danger" name="-1 <?php echo ($row["empID"]) ?>" class="w3-button w3-red" <?php echo ($row[$user] == -1) ? 'disabled' : '' ?>>REJECT</button>
                                </div>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>



</body>