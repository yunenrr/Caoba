<?php include './header.php' ?>
<div>
    <table>
        <thead>
            <tr>
                <th>Instructor</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Payment methods</th>
                <th>Quota</th>
                <th>Start date</th>
                <th>End date</th>
                <th>Update/Delete</th>
            </tr>
        </thead>
        <tbody id="tableBodyService">
            <tr>
                <td><input type="text" value="Juean" /></td>
                <td><input type="text" value="Boxing" /></td>
                <td><input type="text" value="Description" /></td>
                <td><input type="number" value="2000" /></td>
                <td>
                    <select><option>a</option><option>b</option></select>
                    <button>a</button>
                    <button>b</button>
                </td>
                <td><input type="number" value="25" /></td>
                <td><input type="date" /></td>
                <td><input type="date" /></td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td><input type="button" value="Insert" id="btnInsert" name="btnInsert" /></td>
            </tr>
        </tfoot>
    </table>
    <div id="msg"></div>
</div>
<?php include './footer.php' ?>
<script type="text/javascript">
    $(document).ready
    (
        function()
        {
        }//Fin de la función principal
    );///Fin del $(document).ready
</script>