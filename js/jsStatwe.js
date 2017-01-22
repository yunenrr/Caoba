function enableButtons(id) {
    $('#btnEdit' + id).attr("disabled", "false");
    $('#btnEna' + id).removeAttr('disabled');
    $('#btnDis' + id).removeAttr('disabled');
    alert("d");
}

function insert(id, ban) {
    alert('d');
    if ($('#' + id).attr('value') !== '-1') {
        update(id, ban);
        alert('ddd');
    } else {
        alert('dc');
        var data = $('#form' + id).serializeArray();
        data.push({name: 'state', value: ban});
        data.push({name: 'id', value: id});
        ajaxRequest(data, '../business/PersonStateInsertAction.php');
        if (ban === 1) {
            alert('dm');
            $('#btnEna' + id).attr("disabled", "false");
            $('#' + id).val('0');
            $('#' + id).attr('value', '1');
        } else {
            $('#btnDis' + id).attr("disabled", "false");
            $('#' + id).attr('value', '0');
        }
    }
}

function update(id, state) {
    var data = $('#form').serializeArray();
    alert('d3w');
    if ($('#' + id).attr('value') === '0') {
        $('#btnDis' + id).removeAttr('disabled');
        $('#btnEna' + id).attr("disabled", "false");
        $('#' + id).attr('value', 1);
        data.push({name: 'state', value: 1});
    } else {
        $('#btnEna' + id).removeAttr('disabled');
        $('#btnDis' + id).attr("disabled", "false");
        $('#' + id).attr('value', 0);
        data.push({name: 'state', value: 0});
    }
    data.push({name: 'id', value: id});
    ajaxRequest(data, '../business/PersonStateUpdateAction.php');
}

function ajaxRequest(data, path) {
    $.ajax({
        url: path,
        type: 'post',
        dataType: 'json',
        data: data
    });
}