<?php
session_start();
//Checking User Logged or Not
if (empty($_SESSION['user'])) {
    header('location:index.php');
}
// //Restrict User or Moderator to Access Admin.php page
if ($_SESSION['user']['role'] == 'User') {
    header('location:add.php');
}


$user = $_SESSION['user']['role'];
$conn = mysqli_connect("localhost", "root", "", "logindb");



$id = 0;
if (isset($_POST) && $_SESSION['user']['role'] == $user) {
    foreach ($_POST as $key => $value) {
        $value = explode("_", $key)[0];
        $id = explode("_", $key)[1];
        $out = mysqli_query($conn, "UPDATE aproval SET $user=$value WHERE empID=$id");
    }
}
switch ($_SESSION['user']['role']) {
    case 'Admin':
        $result = mysqli_query($conn, "SELECT * FROM employee INNER JOIN aproval on employee.empID=aproval.empID ORDER by employee.empID DESC");
        break;
    case 'HoAdmin':
        $result = mysqli_query($conn, "SELECT * FROM employee INNER JOIN aproval on employee.empID=aproval.empID WHERE aproval.Admin=1 ORDER by employee.empID DESC");
        break;
    case 'Edp':
        $result = mysqli_query($conn, "SELECT * FROM employee INNER JOIN aproval on employee.empID=aproval.empID WHERE aproval.Hoadmin=1 ORDER by employee.empID DESC");
        break;
    case 'Md':
        $result = mysqli_query($conn, "SELECT * FROM employee INNER JOIN aproval on employee.empID=aproval.empID WHERE aproval.Edp=1 ORDER by employee.empID DESC");
        break;
}


?>
<html>

<head>
    <Script>
        function pop_up(url) {
            window.open(url, 'win2', 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=1076,height=768,directories=no,location=no')
        }

        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("<?php echo ($id) ?>").scrollIntoView({
                block: "center"
            });
        });
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

            <nav class="navbar navbar-dark bg-dark" style=" align-content: center ;height:80">
                <a class="navbar-brand">
                    <img src="rubco.jpg" height="50" class="d-inline-block align-center" alt="" style="padding-bottom: 10" />
                    <span class="navbar-text navbar-light h1" style="color: white">
                        Rubco
                    </span></a>
                <form class="form-inline" style="padding-top: 10" action="logout.php">

                    <div class="d-inline-block " style=" color: white">
                        <div class="bd-highlight pr-3 ">USER: <?php echo $_SESSION['user']['username']; ?></div>
                        <div class="bd-highlight pr-3">ROLE: <?php echo $_SESSION['user']['role']; ?></div>
                    </div>
                    <div class="d-inline-block">

                        <button class="btn btn-outline-danger" type="Logout">
                            Logout
                        </button>
                    </div>
                </form>
            </nav>
        </div>
    </div>

    <div class="tableClass">

        <table class="table table-striped table-warning table-hover table-sm table-borderd" style="word-break: break-all">
            <thead class="bg-warning">
                <tr class="table-active">
                    <th scope="col">ID</th>
                    <th scope="col">Employee Name</th>
                    <th scope="col" class="col-1"><?php echo $_SESSION['user']['users']['1'] ?></th>
                    <th scope="col" class="col-1"><?php echo $_SESSION['user']['users']['4'] ?></th>
                    <th scope="col" class="col-1"><?php echo $_SESSION['user']['users']['3'] ?></th>
                    <th scope="col" class="col-1"><?php echo $_SESSION['user']['users']['2'] ?></th>
                    <th scope="col" class="col-2">APPROVE / REJECT</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $count = 0;
                while ($row = mysqli_fetch_array($result)) {
                    $count++
                ?>

                    <tr>
                        <td scope="row" id="<?php echo $row["empID"] ?>"><?php echo $count ?></th>
                        <td style="cursor: pointer;" onclick="pop_up('view.php?id=<?php echo $row['empID'] ?>')">
                            <?php echo ($row['employeeName']) ?>
                            </th>
                        <td class="text-center bg-<?php echo (($row[$_SESSION['user']['users']['1']] == 1) ? 'success' : (($row[$_SESSION['user']['users']['1']] == -1) ? 'danger' : 'light')) ?>"><?php echo (($row[$_SESSION['user']['users']['1']] == 1) ? 'APPROVED' : (($row[$_SESSION['user']['users']['1']] == -1) ? 'REJECTED' : 'PENDING')) ?></th>
                        <td class="text-center bg-<?php echo (($row[$_SESSION['user']['users']['4']] == 1) ? 'success' : (($row[$_SESSION['user']['users']['4']] == -1) ? 'danger' : 'light')) ?>"><?php echo (($row[$_SESSION['user']['users']['4']] == 1) ? 'APPROVED' : (($row[$_SESSION['user']['users']['4']] == -1) ? 'REJECTED' : 'PENDING')) ?></th>
                        <td class="text-center bg-<?php echo (($row[$_SESSION['user']['users']['3']] == 1) ? 'success' : (($row[$_SESSION['user']['users']['3']] == -1) ? 'danger' : 'light')) ?>"><?php echo (($row[$_SESSION['user']['users']['3']] == 1) ? 'APPROVED' : (($row[$_SESSION['user']['users']['3']] == -1) ? 'REJECTED' : 'PENDING')) ?></th>
                        <td class="text-center bg-<?php echo (($row[$_SESSION['user']['users']['2']] == 1) ? 'success' : (($row[$_SESSION['user']['users']['2']] == -1) ? 'danger' : 'light')) ?>">
                            <?php echo (($row[$_SESSION['user']['users']['2']] == 1) ? 'APPROVED' : (($row[$_SESSION['user']['users']['2']] == -1) ? 'REJECTED' : 'PENDING')) ?></th>
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