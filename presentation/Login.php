<?php
include './header.php';
session_start();
if(isset($_SESSION['id'])){
    header("location: ./Home.php");
}
?>

<div>

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