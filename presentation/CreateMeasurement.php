<?php
include './header.php';
?>

<div>

    <form name="formMedition">

        <table>
            <!--  -->
            <tr>
                <td></td>
                <td></td>
            </tr>
        </table>

    </form>

</div>

<script type="text/javascript">

    (function ($) {
        $.get = function (key) {
            key = key.replace(/[\[]/, '\\[');
            key = key.replace(/[\]]/, '\\]');
            var pattern = "[\\?&]" + key + "=([^&#]*)";
            var regex = new RegExp(pattern);
            var url = unescape(window.location.href);
            var results = regex.exec(url);
            if (results === null) {
                return null;
            } else {
                return results[1];
            }
        }
    })(jQuery);

    var idPerson = $.get("id");

</script>
