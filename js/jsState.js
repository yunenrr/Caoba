function enableButtons(id) {
    $('#btnEdit' + id).attr("disabled", "false");
    $('#btnEna' + id).removeAttr('disabled');
    $('#btnDis' + id).removeAttr('disabled');
}

function insert(id, ban) {
    if ($('#' + id).attr('value') !== '-1') {
        update(id, ban);
    } else {
        var data = $('#form' + id).serializeArray();
        data.push({name: 'state', value: ban});
        data.push({name: 'id', value: id});
        ajaxRequest(data, '../business/PersonStateInsertAction.php');
        if (ban === 1) {
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
$(document).ready(function () {
    $('.time').mask('YA:F0:B0', {'translation': {
            Y: {pattern: /[0-2]/},
            A: {pattern: /[0-3]/},
            F: {pattern: /[0-5]/},
            B: {pattern: /[0-5]/}
        }
    });
    $('.money').mask('0 000 000 00 ₡', {reverse: true});
});