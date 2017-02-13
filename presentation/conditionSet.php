<?php include './header.php' ?>
<div>
    <table border="1px" cellpadding="10px">
        <thead>
            <tr>
                <th>Name</th>
                <th>Level</th>
                <!--<th>DELETE</th>-->
            </tr>
        </thead>
        <tbody id="tableCondition">
        </tbody>
    </table>
    <br/>
    <table border>
        <thead>
            <tr>
                <!--<th><input id="name" ></th>-->
                <th>
                    <select id="condition"> 
                        <!--                        <option value="0">Muy bajo</option>
                                                <option value="1">Bajo</option>
                                                <option value="2">Medio</option>
                                                <option value="3">Alto</option>
                                                <option value="5">Muy Alto</option>-->
                    </select>
                </th>
                <th><input type="button" value="ADD" onclick="add();"></th>
            </tr>
        </thead>
    </table>
</div>

<script type="text/javascript">

    var id;
    function chargeTable() {
        id = $.get("id");
        $.ajax({
            url: '../business/GetClientCondition.php',
            type: 'POST',
            dataType: 'json',
            data: 'id=' + id + '',
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
    function chargeCombo() {
        var id = $.get("id");
        $.ajax({
            url: '../business/GetCondition.php',
            type: 'POST',
            dataType: 'json',
            data: 'id=' + id + '',
            success: function (data) {
//                alert('dsad');
                var res = JSON.stringify(data);
                var result = JSON.parse(res);
                $("#condition").empty();
                for (i in result)
                {
//                    alert('dsad');
                    var elements = '<option value="' + result[i].idcondition + '">' + result[i].namecondition + '</option>';
                    $("#condition").append(elements);
                }
            },
            error: function (data) {
                alert('124');
            }
        });
    }
    function add() {
        if ($('#name').val() === "") {
        } else {
            $.ajax({
                url: '../business/InsertClientCondition.php',
                type: 'POST',
                data: 'idclient=' + id + '&idcondition=' + $('#condition').val(),
                success: function (data) {
//                    alert('dd');
                    chargeTable();
                },
                error: function (data) {
                    alert('error');
                }
            });
        }
    }
    function deleteCondition(condition) {
//        alert('d');
        $.ajax({
            url: '../business/DeleteClientCondition.php',
            type: 'POST',
            data: 'id=' + id + '&condition=' + condition,
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
    (function ($) {
        $.get = function (key) {
            key = key.replace(/[\[]/, '\\[');
            key = key.replace(/[\]]/, '\\]');
            var pattern = "[\\?&]" + key + "=([^&#]*)";
            var regex = new RegExp(pattern);
            var url = unescape(window.location.href);
            var results = regex.exec(url);
            if (results === null) {
                return null;
            } else {
                return results[1];
            }
        }
    })(jQuery);


//    function addRow() {
//        var elements = '<tr><th>a</th><th>t</th><th></th></tr>';
//        $("#tableCondition").append(elements);
//    }
//    ;
    $(document).ready(function () {
        chargeTable();
        chargeCombo();
    });



</script>





