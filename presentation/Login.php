<!DOCTYPE html>
<html>
    <head lang="es" >
        <title>Gym Caoba</title>
        <script src="../js/jquery-3.1.1.min.js"></script>
        <link href="../css/style.css" rel="stylesheet" type="text/css" media="all" />
    </head>
    <body><div>

    <form name="formInsert" action="../business/LoginAction.php" method="POST">

        <table>
            <tr>
                <td>
                    <label>User: </label>
                </td>
                <td>
                    <input id="user" name="user" type="text" placeholder="Username"/>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Password: </label>
                </td>
                <td>
                    <input id="pass" name="pass" type="password" placeholder="Password"/>
                </td>
            </tr>
        </table>

        <input type="submit" name="submit" value="Login"/>
    </form>

</div>
    </body>