<?php

$result = "hellow";
?>

<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="bootstrap.min.css">

  <style>
    .form {

      padding-bottom: 30;
      margin: auto;

    }
  </style>

</head>

<body>
  <a onclick="pop_up('view.php')"> hello</a>
  <div onclick="pop_up('view.php')" style="width: 100; height:100;background-color:red">
    Launch demo modal</div>
  <table class="table table-striped table-warning table-hover table-sm table-borderd" style="word-break: break-all">
    <thead class="bg-warning">
      <tr class="table-active">
        <th scope="col">ID</th>
        <th scope="col"><a onclick="pop_up('view.php')">
            Launch demo modal
          </a></th>
        <th onclick="pop_up('view.php')" scope="col" class="col-1">officehead</th>
        <th scope="col" class="col-1">admin_3</th>
        <th scope="col" class="col-1">admin_2</th>
        <th scope="col" class="col-1">admin_1</th>
        <th scope="col" class="col-2">APPROVE / REJECT</th>
      </tr>
    </thead>
    <tbody>
      <?php
      while ($result) {
      ?>

        <tr>
          <td scope="row" id="<?php echo $row["empID"] ?>"><?php echo $row["empID"] ?></th>
          <td>
            </th>
          <td class="text-center bg-<?php echo (($row["officehead"] == 1) ? 'success' : (($row["officehead"] == -1) ? 'danger' : 'light')) ?>"><?php echo (($row["officehead"] == 1) ? 'APPROVED' : (($row["officehead"] == -1) ? 'REJECTED' : 'PENDING')) ?></th>
          <td class="text-center bg-<?php echo (($row["admin_3"] == 1) ? 'success' : (($row["admin_3"] == -1) ? 'danger' : 'light')) ?>"><?php echo (($row["admin_3"] == 1) ? 'APPROVED' : (($row["admin_3"] == -1) ? 'REJECTED' : 'PENDING')) ?></th>
          <td class="text-center bg-<?php echo (($row["admin_2"] == 1) ? 'success' : (($row["admin_2"] == -1) ? 'danger' : 'light')) ?>"><?php echo (($row["admin_2"] == 1) ? 'APPROVED' : (($row["admin_2"] == -1) ? 'REJECTED' : 'PENDING')) ?></th>
          <td class="text-center bg-<?php echo (($row["admin_1"] == 1) ? 'success' : (($row["admin_1"] == -1) ? 'danger' : 'light')) ?>">
            <?php echo (($row["admin_1"] == 1) ? 'APPROVED' : (($row["admin_1"] == -1) ? 'REJECTED' : 'PENDING')) ?></th>
          <td>
            <form method="post" action="adminthree.php">
              <div>
                <button class="btn btn-success" name="1 <?php echo ($row["empID"]) ?>" class="w3-button w3-green" <?php echo ($row["admin_3"] == 1) ? 'disabled' : '' ?>>APPROVE</button>
                <button class="btn btn-danger" name="-1 <?php echo ($row["empID"]) ?>" class="w3-button w3-red" <?php echo ($row["admin_3"] == -1) ? 'disabled' : '' ?>>REJECT</button>
              </div>
            </form>
          </td>
        </tr>
      <?php $result = 0;
      } ?>
    </tbody>
  </table>


</body>
<script>
  function pop_up(url) {
    window.open(url, 'win2', 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=1076,height=768,directories=no,location=no')
  }
</script>

</html>