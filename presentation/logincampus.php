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
            <select id="selCampus" name="selCampus">
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
                var currentQR = "";
                var oldQR = "-1";
                
                // init bunch of sounds
                ion.sound
                (
                    {
                        sounds: 
                        [
                            {name: "correct"},
                            {name: "notexist"},
                            {name: "notservice"},
                            {name: "activesession"}
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
                        currentQR = data;
                        
                        if(currentQR !== oldQR)
                        {
                            $("#msg").html("");
                            var infoData = "option=1&dniPerson="+data+
                                    "&idCampus="+$("#selCampus").val();
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
                                                 ion.sound.play("correct");
                                                 $("#msg").html("Bienvenido(a)"); 
                                             }//Fin del if igual a existe
                                             else if(dataBusiness === "2")
                                             {
                                                 ion.sound.play("notservice");
                                                 $("#msg").html("En estos momentos no se está impartiendo ningún servicio en la sala.");
                                             }//Fin del else if
                                             else if(dataBusiness === "3")
                                             {
                                                 ion.sound.play("activesession");
                                                 $("#msg").html("Usted ya está registrado para la sesión actual en una sala.");
                                             }//Fin del else if
                                             else
                                             {
                                                 ion.sound.play("notexist");
                                                 $("#msg").html("Usted no está registrado en el sistema.");
                                             }//Fin del else
                                         }//Fin del if mayor a cero
                                         else
                                         {
                                             $("#msg").html(getErrorMessage(5));
                                         }
                                         oldQR = currentQR;
                                     },
                                     error:function()
                                     {
                                         $("#msg").html(getErrorMessage(5));
                                     }
                                 }
                             );
                        }//Fin del if
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