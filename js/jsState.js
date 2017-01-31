function update(id) {
    $.ajax({
        url: '../business/PersonStateUpdateAction.php',
        type: 'post',
        dataType: 'json',
        data: {"NombreFruta": id},
        success: function (data)
        {
            $("#status").empty();
            if (data.status == "0") {
//                alert('entro');
               $("#status").html("ENABLE");
            } else {
//                alert('no entro');
                $("#status").html("DISABLE"); 
            }
//            alert(data.status);
        },
        error: function (data)
        {
//            alert(data.status);
        }
    });
}