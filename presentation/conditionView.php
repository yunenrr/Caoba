<?php include './header.php' ?>
<div>
    <table border>
        <thead>
            <tr>
                <th>Name</th>
                <th>Level</th>
                <th>DELETE</th>
            </tr>
        </thead>
        <tbody id="tableCondition">
        </tbody>
    </table>
    <br/>
    <table border>
        <thead>
            <tr>
                <th><input id="name" ></th>
                <th>
                    <select id="risk"> 
                        <option value="0">Muy bajo</option>
                        <option value="1">Bajo</option>
                        <option value="2">Medio</option>
                        <option value="3">Alto</option>
                        <option value="5">Muy Alto</option>
                    </select>
                </th>
                <th><input type="button" value="ADD" onclick="add();"></th>
            </tr>
        </thead>
    </table>
</div>

<script type="text/javascript">


    function chargeTable() {
        $.ajax({
            url: '../business/GetCondition.php',
            type: 'POST',
            dataType: 'json',
            success: function (data) {
                var res = JSON.stringify(data);
                var result = JSON.parse(res);
                $("#tableCondition").empty();
                for (i in result)
                {
                    var elements = '<tr><th>' + result[i].namecondition + '</th><th>' + riskName(result[i].risklevelcondition) + '</th><th><input type="button" onclick="deleteCondition(' + result[i].idcondition + ');" value="DELETE"></th></tr>';
                    $("#tableCondition").append(elements);
                }
            },
            error: function (data) {

            }
        });
    }
    function add() {
        if ($('#name').val() === "") {
        } else {
            $.ajax({
                url: '../business/InsertCondition.php',
                type: 'POST',
                data: 'name=' + $('#name').val() + '&risk=' + $('#risk').val(),
                success: function (data) {
                    chargeTable();
                },
                error: function (data) {
                    alert('error');
                }
            });
        }
    }
    function deleteCondition(id) {
//        alert('d');
        $.ajax({
            url: '../business/DeleteCondition.php',
            type: 'POST',
            data: 'id=' + id + '',
//            dataType: 'json',
            success: function (data) {
                chargeTable();
            },
            error: function (data) {
                alert('error');
            }
        });
    }
    function riskName(risknum) {
        if (risknum === '0') {
            return 'Muy Bajo';
        } else if (risknum === '1') {

            return 'Bajo';
        } else if (risknum === '2') {

            return 'Medio';
        } else if (risknum === '3') {

            return 'Alto';
        } else if (risknum === '4') {

            return 'Muy Alto';
        }
    }

    $(document).ready(function () {
        chargeTable();
    });

</script>





