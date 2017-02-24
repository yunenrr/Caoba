<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Salas</title>
        <script src="../js/jquery-3.1.1.min.js"></script>
        <script src="../js/jsMessage.js"></script>
        <script src="../resources/html5-qrcode/src/html5-qrcode.js"></script>
        <script src="../resources/html5-qrcode/lib/jsqrcode-combined.min.js"></script>
        <script src="../resources/ion.sound-3.0.7/ion.sound.min.js"></script>
    </head>
    <body>
        <div>
            <select>
                <option value="0">Sala 1</option>
                <option value="1">Sala 2</option>
            </select>
        </div>
        <div id="reader" style="width:400px;height:350px"></div>
        <div id="msg"></div>
    </body>
    <script type="text/javascript">
        $(document).ready
        (
            function () 
            {
                // init bunch of sounds
                ion.sound
                (
                    {
                        sounds: 
                        [
                            {
                                name: "correcto"
                            }
                        ],

                        // main config
                        path: "../resources/ion.sound-3.0.7/sounds/",
                        preload: true,
                        multiplay: true,
                        volume: 1.0
                    }
                );

                $('#reader').html5_qrcode
                (
                    function (data) 
                    {
                        $("#msg").html("");
                        var infoData = "option=1&dniPerson="+data;
                         $.ajax
                         (
                             {
                                 type: 'POST',
                                 url: "../business/HistoryCampusBusiness.php",
                                 data: infoData,
                                 beforeSend: function(before)
                                 {
                                     $("#msg").html(getWaitMessage());
                                 },
                                 success: function(dataBusiness)
                                 {
                                     if(dataBusiness.toString().length > 0)
                                     {
                                         if(dataBusiness === "1")
                                         {
                                             ion.sound.play("correcto");
                                             $("#msg").html("Bienvenido(a)"); 
                                             $().delay(1000);
                                         }//Fin del if igual a existe
                                     }//Fin del if mayor a cero
                                     else
                                     {
                                         $("#msg").html(getErrorMessage(5));
                                     }
                                 },
                                 error:function()
                                 {
                                     $("#msg").html(getErrorMessage(5));
                                 }
                             }
                         );
                    },
                    function (error) 
                    {
                        console.log(error);
                    }, 
                    function (videoError) 
                    {
                        console.log(videoError);
                    }
                );
           }
        );    
    </script>
</html>