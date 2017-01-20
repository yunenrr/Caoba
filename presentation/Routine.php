<?php
include './header.php';
?>

<div>

    <table>

        <tr>
            <td>
                <!--SHOW ROUTINE-->
                <div>
                    <!--ABDOMEN-->
                    <div id="divABDOMEN">
                        <h1>ABDOMEN</h1>
                        <table border="1" id="tbABDOMEN"> 
                            <tr>
                                <th>EXERCIXE</th>
                                <th>SERIES</th>
                                <th>REPETITIONS</th>
                                <th>COMMENT</th>
                            </tr>
                        </table>
                    </div>

                    <!--SHOULDERS-->
                    <div id="divSHOULDERS">
                        <h1>SHOULDERS</h1>
                        <table border="1" id="tbSHOULDERS"> 
                            <tr>
                                <th>EXERCIXE</th>
                                <th>SERIES</th>
                                <th>REPETITIONS</th>
                                <th>COMMENT</th>
                            </tr>
                        </table>
                    </div>

                    <!--BICEPS-->
                    <div id="divBICEPS">
                        <h1>BICEPS</h1>
                        <table border="1" id="tbBICEPS"> 
                            <tr>
                                <th>EXERCIXE</th>
                                <th>SERIES</th>
                                <th>REPETITIONS</th>
                                <th>COMMENT</th>
                            </tr>
                        </table>
                    </div>

                    <!--TRICEPS-->
                    <div id="divTRICEPS">
                        <h1>TRICEPS</h1>
                        <table border="1" id="tbTRICEPS"> 
                            <tr>
                                <th>EXERCIXE</th>
                                <th>SERIES</th>
                                <th>REPETITIONS</th>
                                <th>COMMENT</th>
                            </tr>
                        </table>
                    </div>

                    <!--CHEST-->
                    <div id="divCHEST">
                        <h1>CHEST</h1>
                        <table border="1" id="tbCHEST"> 
                            <tr>
                                <th>EXERCIXE</th>
                                <th>SERIES</th>
                                <th>REPETITIONS</th>
                                <th>COMMENT</th>
                            </tr>
                        </table>
                    </div>

                    <!--BACK-->
                    <div id="divBACK">
                        <h1>BACK</h1>
                        <table border="1" id="tbBACK"> 
                            <tr>
                                <th>EXERCIXE</th>
                                <th>SERIES</th>
                                <th>REPETITIONS</th>
                                <th>COMMENT</th>
                            </tr>
                        </table>
                    </div>

                    <!--LEGS-->
                    <div id="divLEGS">
                        <h1>LEGS</h1>
                        <table border="1" id="tbLEGS"> 
                            <tr>
                                <th>EXERCIXE</th>
                                <th>SERIES</th>
                                <th>REPETITIONS</th>
                                <th>COMMENT</th>
                            </tr>
                        </table>
                    </div>

                </div>
            </td>
        </tr>

        <tr>
            <td>
                <!--INSERT EXERCIXE-->
                <div id="divInsert">
                    <h1 id="title"></h1>

                    <form name="formRoutine" action="../business/CreateNewRoutineAction.php" method="POST">

                        <input id="idPerson" name="idPerson" type="number">
                        <input id="exercises" name="exercises" type="number">
                        <input id="namePerson" name="namePerson" type="text">

                        <!--EXERCIXE-->
                        <table border="1" id="exercise">

                            <tr>
                                <th>EXERCIXE</th>
                                <th>SERIES</th>
                                <th>REPETITIONS</th>
                                <th>COMMENT</th>
                                <th>MUSCLE</th>
                                <th>DELETE</th>
                            </tr>

                            <tr id="tr0">

                                <!--NAME-->
                                <td>
                                    <input id="exercise0" name="exercise0" type="text">
                                </td>

                                <!--SERIES-->
                                <td>
                                    <input id="series0" name="series0" type="number">
                                </td>

                                <!--REPETITIONS-->
                                <td>
                                    <input id="repetitions0" name="repetitions0" type="number">
                                </td>

                                <!--COMMENT-->
                                <td>
                                    <textarea id="comment0" name="comment0" rows="5" cols="40" required ></textarea>
                                </td>

                                <!--MUSCLE-->
                                <td>
                                    <SELECT NAME="comboExercise0" SIZE=1> 
                                        <OPTION VALUE="0">ABDOMEN</OPTION>
                                        <OPTION VALUE="1">SHOULDERS</OPTION>
                                        <OPTION VALUE="2">BICEPS</OPTION>
                                        <OPTION VALUE="3">TRICEPS</OPTION> 
                                        <OPTION VALUE="4">CHEST</OPTION> 
                                        <OPTION VALUE="5">BACK</OPTION> 
                                        <OPTION VALUE="6">LEGS</OPTION> 
                                    </SELECT> 
                                </td>

                                <!--DELETE EXERCIXE-->
                                <td>
                                    <input id="deleteExercise0" type="button" onclick="deleteExercise(-1);" value="Delete">
                                </td>

                            </tr>

                        </table>

                        <br>
                        <input id="AddExercise" type="button" onclick="addExercise();" value="Add Exercise">
                        <br>
                        <br>

                        <!--REGISTRE ROUTINE-->
                        <div>
                            <input type="submit" name="submit" value="Register Routine">
                        </div>

                    </form>
                </div>
            </td>
        </tr>

    </table>

</div>

<script type="text/javascript">

    function init() {
        var idPerson = $.get("id");

        $('#divInsert').hide();
        $('#divABDOMEN').hide();
        $('#divSHOULDERS').hide();
        $('#divBICEPS').hide();
        $('#divTRICEPS').hide();
        $('#divCHEST').hide();
        $('#divBACK').hide();
        $('#divLEGS').hide();
        $('#idPerson').hide();
        $('#idPerson').val(idPerson);

        var name = $.get("name");
        name = name.replace("_", " ");
        document.getElementById("title").innerHTML = "Assign exercise to " + name;

        $('#namePerson').hide();
        $('#namePerson').val(name);
        $('#exercises').hide();
        
        $('#divInsert').show();
    }

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

    $(function () {
        init();
        $.ajax({
            type: 'GET',
            url: "../business/GetRoutine.php",
            data: {"id": $.get("id")},
            success: function (data)
            {
                var exercixes = JSON.parse(data);

                $.each(exercixes, function (i, item) {
                    showRoutine(item);
                });
            },
            error: function ()
            {

            }
        });
    });

    var idExercise = 1;
    function addExercise() {

        var trStar = '<tr id="tr' + idExercise + '">';
        var tdName = '<td><input id="exercise' + idExercise + '" name="exercise' + idExercise + '" type="text"></td> ';
        var tdSeries = '<td><input id="series' + idExercise + '" name="series' + idExercise + '" type="number"></td>';
        var tdRepetitons = '<td><input id="repetitions' + idExercise + '" name="repetitions' + idExercise + '" type="number"></td>';
        var tdComment = '<td><textarea id="comment' + idExercise + '" name="comment' + idExercise + '" rows="5" cols="40" required ></textarea></td>';
        var tdMuscle = '<td><SELECT NAME="comboExercise' + idExercise + '" SIZE=1>' +
                '<OPTION VALUE="0">ABDOMEN</OPTION>' +
                '<OPTION VALUE="1">SHOULDERS</OPTION>' +
                '<OPTION VALUE="2">BICEPS</OPTION>' +
                '<OPTION VALUE="3">TRICEPS</OPTION>' +
                '<OPTION VALUE="4">CHEST</OPTION>' +
                '<OPTION VALUE="5">BACK</OPTION>' +
                '<OPTION VALUE="6">LEGS</OPTION>' +
                '</SELECT> </td>';
        var tdDelete = '<td><input id="deleteExercise' + idExercise + '" type="button" onclick="deleteExercise(' + idExercise + ');" value="Delete"></td>';
        var trEnd = '</tr>';
        var newTR = trStar + tdName + tdSeries + tdRepetitons + tdComment + tdMuscle + tdDelete + trEnd;
        $('#exercise tr:last').after(newTR);
        idExercise++;
        $('#exercises').val(idExercise);
    }

    function deleteExercise(id) {
        $("#tr" + id).remove();
    }

    function showRoutine(exercixe) {
        var muscle = exercixe.muscleRoutine;
        if (muscle === "0") {
            insertContent("divABDOMEN", exercixe, "tbABDOMEN");
        } else {
            if (muscle === "1") {
                insertContent("divSHOULDERS", exercixe, "tbSHOULDERS");
            } else {
                if (muscle === "2") {
                    insertContent("divBICEPS", exercixe, "tbBICEPS");
                } else {
                    if (muscle === "3") {
                        insertContent("divTRICEPS", exercixe, "tbTRICEPS");
                    } else {
                        if (muscle === "4") {
                            insertContent("divCHEST", exercixe, "tbCHEST");
                        } else {
                            if (muscle === "5") {
                                insertContent("divBACK", exercixe, "tbBACK");
                            } else {
                                if (muscle === "6") {
                                    insertContent("divLEGS", exercixe, "tbLEGS");
                                }
                            }
                        }
                    }
                }
            }
        }


    }

    function insertContent(div, exercixe, table) {
        $('#' + div).show();
        var id = exercixe.idRoutine;

        var trStar = '<tr id="tr' + id + '">';
        var tdName = '<td><input id="exercixeContent' + id + '" name="exercixeContent' + id + '" type="text" value="' + exercixe.nameRoutine + '" readonly="readonly"></td> ';
        var tdSeries = '<td><input id="seriesContent' + id + '" name="seriesContent' + id + '" type="number" value="' + exercixe.seriesRoutine + '" readonly="readonly"></td>';
        var tdRepetitons = '<td><input id="repetitionsContent' + id + '" name="repetitionsContent' + id + '" type="number" value="' + exercixe.repetitionsRoutine + '" readonly="readonly"></td>';
        var tdComment = '<td><textarea id="commentContent' + id + '" name="commentContent' + id + '" rows="5" cols="40" required readonly="readonly">' + exercixe.commentRoutine + '</textarea></td>';

        var tdEdit = '<td><input id="edit' + id + '" type="button" onclick="edit(' + id + ');" value="Edit">';
        var tdUpdate = '<input id="update' + id + '" type="button" onclick="update(' + id + ');" value="Update"></td>';
        var tdDelete = '<td><input id="delete' + id + '" type="button" onclick="deleteEx(' + id + ');" value="Delete"></td>';

        var trEnd = '</tr>';

        var newTR = trStar + tdName + tdSeries + tdRepetitons + tdComment + tdEdit + tdUpdate + tdDelete + trEnd;

        $('#' + table + ' tr:last').after(newTR);
        $('#update' + id).hide();
    }

    function edit(id) {
        $("#exercixeContent" + id).removeAttr("readonly");
        $("#seriesContent" + id).removeAttr("readonly");
        $("#repetitionsContent" + id).removeAttr("readonly");
        $("#commentContent" + id).removeAttr("readonly");

        $("#edit" + id).hide();
        $("#update" + id).show();
    }

    function update(id) {
        var data = {
            "id": id,
            "exercixe": $("#exercixeContent" + id).val(),
            "series": $("#seriesContent" + id).val(),
            "repetitions": $("#repetitionsContent" + id).val(),
            "comment": $("#commentContent" + id).val()
        };

        $.ajax({
            type: "POST",
            url: "../business/UpdateRoutineAction.php",
            data: data,
            success: function (res) {
                if (res == true) {

                    $("#exercixeContent" + id).attr("readonly", "readonly");
                    $("#seriesContent" + id).attr("readonly", "readonly");
                    $("#repetitionsContent" + id).attr("readonly", "readonly");
                    $("#commentContent" + id).attr("readonly", "readonly");

                    $("#update" + id).hide();
                    $("#edit" + id).show();
                } else {
                    alert("Error update");
                }
            }
        });
    }

    function deleteEx(id) {
        var data = {
            "id": id
        };
        $.ajax({
            type: "POST",
            url: "../business/DeleteRoutineAction.php",
            data: data,
            success: function (res) {
                if (res == true) {
                    var name = $.get("name");
                    name = name.replace(" ", "_");
                    window.location = "./Routine.php?id=" + $.get("id") + "&name=" + name;
                } else {
                    alert("Error delete");
                }
            }
        });
    }


</script>

