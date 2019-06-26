<?php session_start();
require("user.php");?>

<html>

<head>
<link rel="stylesheet" type="text/css" href="style.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="mod23.js"></script>

    <script type="text/javascript" charset="utf-8">
        $(document).ready(function() {

            var options = '';
            $.ajax({
                type: 'GET',
                url: 'http://localhost/visual_store_manager/ditta.php',
                success: function (data) {
                    if (data.msg) {
                        alert(data.msg);
                    } else {

                        $.each(data, function (i, dato) {

                            options += '<option value='+dato.nome_ditta+'>' + dato.nome_ditta + '</option>';

                        });
                        $("[name='ditta']").html(options);
                    }//else
                }//success function
            });//ajax
        });


    </script>
</head>

<body>
<?php include 'backtomenu.html'; ?>
<?php include 'header.php'?>
<form action="">
<div id="modelcontainer">
    <table>
        <tr><td>Data: <?php echo date("d/m/Y")?></tr>
        <tr><td>Ditta che esegue l'intervento</td><td>
                <select required name="ditta">

                </select>
            </td></tr>
        <tr><td>Manutenzione</td>
            <td>
                <select name="tipoman">
                    <option value="ord">Ordinaria</option>
                    <option value="straord">Straordinaria</option>
                </select>
            </td>
        </tr>
        <tr><td>Riferimento richiesta autorizzazione </td><td><input type="text" name="resp" placeholder="cognome"></td></tr>
        <tr><td>Operazioni eseguite </td><td><textarea name="operazioni"></textarea></td></tr>
        <tr><td>Attrezzature oggetto di intervento </td><td><textarea name="attrezz"></textarea></td></tr>
        <tr><td>Durata intervento in ore </td><td><input type="number" name="durata"> x 
            <input type="number" name="noperai" maxlength="2" placeholder="numero operai"></td>
        </tr>
        <tr><td>Materiali impiegati</td><td><textarea name="mat"></textarea></td></tr>
        <tr><td>Intervento </td>
            <td><select name="oss">
                <option value="sodd">Soddisfacente</option>
                <option value="insodd">Insoddisfacente</option>
                </select></td>
        </tr>
        <tr><td>Osservazioni gestore</td>
            <td>Altro <input id="altro" type="checkbox" onchange="valueChanged()" checked></td>
        </tr>
        <tr>
            <td></td></td><td><textarea id="comment" rows='4' cols='50' name='comment' placeholder='Commento?'></textarea></td>
        </tr>

    </table>
    <div id="aut">
        <input type="text" name="id_dip" placeholder="ID dipendente" required><br><br>
        <input type="password" name="pwd_dip" placeholder="password" required><br><br>
        <input type="button" value="INVIA" id="submit_man" onclick="ajx_man()">
    </div>
</div>
</form>

</body>
</html>

<script>
    function valueChanged()
    {
        if($('#altro').is(":checked"))
            $("#comment").show();
        else
            $("#comment").hide();
    }
</script>

