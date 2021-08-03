<?php
echo print_r($_POST);
if (isset($_POST['submit'])) {
    foreach ($_POST as $name => $item) {
        if ($name != 'submit') {
            for ($m = 0; $m < sizeof($item); $m++) {
                echo ($name . ' ' . $item[$m] . '<br>');
            }
        }
    }
}
?>

<html>

<head>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>

    <form method="post" action="test.php">
        <!-- <div>
            <div>
                <p>
                    <label id="hello" class="reg_label" for="field_name">Item:</label>
                    <input class="text_area" name="field_name[]" type="text" id="testing" tabindex="98" style="width: 150px;" />
                </p>
            </div>
        </div>
        <input type="button" id="btnDel" value="Remove" class="someClass2" disabled /><br><br> -->

        <input type="button" id="btnAdd" value="Add" class="someClass1" onclick="add()" />




        <table class="table table-striped table-warning align-content-center w-100" id="addProducts">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Item</th>
                    <th scope="col">Size_Specifications</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Amount</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td scope="row"><input class="form-control-plaintext border-secondary border-top-0" name="id_0"></td>
                    <td scope="row"><input class="form-control-plaintext border-secondary border-top-0" name="item_0"></td>
                    <td scope="row"><input class="form-control-plaintext border-secondary border-top-0" name="size_0"></td>
                    <td scope="row"><input class="form-control-plaintext border-secondary border-top-0" name="quantity_0"></td>
                    <td scope="row"><input class="form-control-plaintext border-secondary border-top-0" name="amount_0"></td>
                </tr>
            </tbody>
        </table>
</body>

<input type="submit" id="submit" name="submit" value="Submit">
</form>
<script>
    // var j = 0;
    // $(document).ready(function() {
    //     $('.someClass1').click(function(e) {

    //         var num = $(this).prev().children().length;
    //         var newNum = new Number(num + 1);

    //         var newElem = $(this).prev().children(':last').clone().attr('id', 'input' + newNum);

    //         if (newElem.children().children().last().hasClass('otherOption')) {
    //             newElem.children().children().last().remove();
    //         }

    //         newElem.children().children().each(function() {
    //             var curName = $(this).attr('name');
    //             var newName = '';
    //             $(this).attr('id', 'name' + num + '_' + j);
    //             j++;
    //         });

    //         newElem.children().children().each(function() {
    //             $(this).removeAttr('value');
    //         });

    //         $(this).prev().children(':last').after(newElem);

    //         $(this).next().removeAttr('disabled');
    //     });

    //     $('.someClass2').click(function(e) {
    //         var num = $(this).prev().prev().children().length;

    //         $(this).prev().prev().children(':last').remove();
    //         if (num - 1 == 1) $(this).attr('disabled', 'disabled');
    //     });
    // });




    var count = 1;

    function add() {
        var table = document.getElementById("addProducts");
        var len = table.rows[0].cells.length;
        var row = table.insertRow(1);
        var cell0 = row.insertCell(0);
        var cell1 = row.insertCell(1);
        var cell2 = row.insertCell(2);
        var cell3 = row.insertCell(3);
        var cell4 = row.insertCell(4);
        cell0.innerHTML = "<input class='form-control-plaintext border-secondary border-top-0' name='id_" + count + "'>";
        cell1.innerHTML = "<input class='form-control-plaintext border-secondary border-top-0' name='Item_" + count + "'>";
        cell2.innerHTML = "<input class='form-control-plaintext border-secondary border-top-0' name='size_" + count + "'>";
        cell3.innerHTML = "<input class='form-control-plaintext border-secondary border-top-0' name='quantity_" + count + "'>";
        cell4.innerHTML = "<input class='form-control-plaintext border-secondary border-top-0' name='amount_" + count + "'>";
        count++;
    }
</script>

</html>