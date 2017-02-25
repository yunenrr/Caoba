<!DOCTYPE html>
<html>
    <head lang="es" >
        <title>Gimnasio Caoba</title>
        <script src="../js/jquery-3.1.1.min.js"></script>
        <link href="../css/style.css" rel="stylesheet" type="text/css" media="all" />
    </head>
    <body><div id="login">
            <form name="formInsert" action="../business/LoginAction.php" method="POST">
                <table>
                    <tr>
                        <td>
                            <label>Usuarios: </label>
                        </td>
                        <td>
                            <input id="user" name="user" type="text" placeholder="Username"/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Contraseña: </label>
                        </td>
                        <td>
                            <input id="pass" name="pass" type="password" placeholder="Password"/>
                        </td>
                    </tr>
                </table>
                <input type="submit" name="submit" value="Ingresar"/>
            </form>
            <a href="#" onclick="ocultarForm()">¿Olvidaste tu contraseña?</a>
        </div>

        <div id="recuperar">
            <fieldset>
                <legend>Recuperar contraseña</legend>
                <div>
                    <table  border="1px" cellpadding="8px">
                        <p>Nombre de usurio: <input type="text" id="txtCorreo" name="txtCorreo"/>*</p>
                        <input type="submit" name="submit" value="Recuperar" onclick="recuperEmail();"/>
                    </table>
                </div>
                <div>Campos requeridos(*)</div></td>
            </fieldset>
            <div id="msg"></div>
            <a href="Login.php">Iniciar sesión</a>
        </div>
    </body>

    <script>

        $(document).ready
                (
                        function ()
                        {
                            document.getElementById('recuperar').style.display = 'none';
                        }
                );
        function ocultarForm() {
            document.getElementById('recuperar').style.display = 'block';
            document.getElementById('login').style.display = 'none';
        }
        function recuperEmail() {
            var correo = $("#txtCorreo").val();
            if (correo.length === 0) {
                $("#msg").html("Por favor ingrese su nombre de usuario.");
            } else {
                $.ajax({
                    type: 'POST',
                    url: "../business/EmailAction.php",
                    data: "option=1&email=" +correo+"&codigo=o",
                    success: function (data) {
                        $("#msg").html(data);
                    },
                    error: function (data) {
                    }
                });
            }
        }
    </script>