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
        </div>


        <div id="recuperar">
            <fieldset>
                <legend>Recuperar contraseña</legend>
                <div>
                    <table  border="1px" cellpadding="8px">
                        <p>Correo: <input type="text" id="txtCorreo" name="txtCorreo" />*</p>
                        <input type="submit" name="submit" value="Recuperar"/>
                    </table>
                </div>
                <div>Campos requeridos(*)</div></td>
            </fieldset>
            <div id="msg"></div>
        </div>
    </body>