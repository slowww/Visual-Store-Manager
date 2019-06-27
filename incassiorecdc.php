<?php
session_start();
require 'connection.php';
require("user.php");
header("Access-Control-Allow-Origin: *");
?>

    <html>
    <head>

        <link href="style.css" type="text/css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script type="text/javascript" src="send_io.js"></script>
    </head>

    <body>
    <?php include 'backtomenu.html'; ?>
    <?php include 'header.php'; ?>
    <div id="modelcontainer">
    <form method="post" id="form">
        <table>
            <tr>
                <td>Ore Tirocinio</td>
                <td>Ore eff. lavorate</td>
                <td>Riduz. oraria</td>
                <td>Ferie</td>
                <td>Permessi retr.</td>
            </tr>
            <tr class="primo">
                <td><input type="number" maxlength="3" size="3" name="tiro" min="0"></td>
                <td><input type="number" maxlength="3" size="3" name="eff" min="0" required></td>
                <td><input type="number" maxlength="1" size="1" name="rid" min="0"></td>
                <td><input type="number" maxlength="3" size="3" name="fe" min="0"></td>
                <td><input type="number" maxlength="3" size="3" name="pr" min="0"></td>
            </tr>
            <tr>
                <td>Malattia</td>
                <td>Maternità</td>
                <td>Varie</td>
                <td>TOT</td>
                <td></td>
            </tr>
            <tr class="primo">
                <td><input type="number" maxlength="3" size="3" name="mal" min="0"></td>
                <td><input type="number" maxlength="3" size="3" name="mat" min="0"></td>
                <td><input type="number" maxlength="3" size="3" name="varie" min="0"></td>
                <td><input maxlength="3" size="3" id="tot" readonly required></td>
                <td><button type="button" onclick="total()">TOTALE</button></td>
            </tr>
            <tr>
                <td>ORGANICO</td>
                <td>In entrata</td>
                <td>In uscita</td>
                <td>STRAORDINARIO</td>
            </tr>
            <tr>

                <td><input type="number" maxlength="3" size="3" name="org" required min="0"></td>
                <td><input type="number" maxlength="3" size="3" name="ent" min="0"></td>
                <td><input type="number" maxlength="3" size="3" name="usc" min="0"></td>
                <td><input maxlength="3" size="3"  id="xtr" readonly required></td>
                <td><button type="button" onclick="str()">STRAORDINARIO</button></td>
            </tr>
            <tr>
                <td>Incasso</td>
                <td>Resa oraria</td><!--verificare se si puo calcolare attraverso i dati inseriti-->
            </tr>
            <tr>
                <td><input type="number" maxlength="6" size="6" name="inc" required min="0"></td>
                <td><input type="number" maxlength="3" size="3" name="resa" required readonly></td>
                <td></td>
                <td></td>
                <td><button type="button" onclick="resah()">RESA</button></td>
            </tr>
        </table>

        <div id="trasf_table">
        <table id="trasferte">
            <tr>
                <td><button type="button" onclick="addTd()">+</button></td>
            </tr>
        </table>
        </div><br>
        <div id="aut">
        <input type="text" name="id_dip" placeholder="ID dipendente" required><br><br>
        <input type="password" name="pwd_dip" placeholder="password" required><br><br>
        <input type="button" value="INVIA" id="submit_io" onclick="ajxSend()">
        </div>
    </form>
    </div>











    <script>
        function total() {
            var total=0;
            var value=0;
            $(".primo [type='number']").each(
                function () {
                    if(!$(this).val())
                    {
                        if($(this).attr("name") === 'eff' )
                        {
                            console.log($(this).attr("name"));
                            alert('Inserire le ore effettivamente lavorate.');
                            return;//non blocca lo script!
                        }else
                        {
                            value=0;
                        }
                    }else {
                        if ($(this).val() < 0) {
                            alert('Uno dei valori inseriti non è corretto.');
                            return;//RITORNA COMUNQUE IL VALOREEEEEEEEEEEEE!!! NON DOVREBBE!!!!
                        } else {
                            value = parseFloat($(this).val());
                        }
                    }
                    total+=value;
                }
            );//each
            $("#tot").val(total);
        }
    </script>
    <script>
        function resah() {

            if(!$("#tot").val()||!$("[name='inc']").val())
            {
                alert('Sono necessari i valori TOTALE e INCASSO.');
            }else
            {

                var inc = $("[name='inc']").val();
                var tot = $("#tot").val();
                var resa = Math.round(inc / tot);
                $("[name='resa']").val(resa);
            }


        }
    </script>
    <script>
       function str() {
           //tot - org -ent + usc
            if(!$("#tot").val()||!$("[name='org']").val())
            {
                alert('Inserire i valori: TOTALE, ORGANICO.');
            }else
            {
                var tot = $("#tot").val();
                var org = $("[name='org']").val();
                var ent = $("[name='ent']").val();
                var usc = parseInt($("[name='usc']").val());
                if(!ent)
                {
                    ent=0;
                }
                if(!usc)
                {
                    usc=0;
                }
                console.log(tot);
                console.log(org);
                console.log(ent);
                console.log(usc);
                var xtr = (tot-org-ent)+usc;
                $("#xtr").val(xtr);
            }
        }
    </script>
    <script>
        $("input[name=usc]").keyup(function(){
            if($(this).val()) {
                $("#trasferte").css('visibility','visible');
                console.log("c'è valore")
            } else {
                $("#trasferte").css('visibility','hidden');
                console.log("no value")
            }
        });
    </script>
    <script>
        function addTd() {
            count=0;
            for(var i=0;i<$("#trasferte input[placeholder=cognome]").length;i++)
            {
                count++;
            }
            if(count<5)
            {
                $("#trasferte").append("<tr id=row"+count+">");
                $("#trasferte tr[id=row"+count+"]").append('<td><input type="text" maxlength="6" size="6" name="cogn'+count+'" placeholder="cognome"></td>');
                $("#trasferte tr[id=row"+count+"]").append('<td><input type="text" maxlength="6" size="6" name="neg'+count+'" placeholder="negozio"></td>');
                $("#trasferte tr[id=row"+count+"]").append('<td><input type="text" maxlength="6" size="6" name="ore'+count+'" placeholder="ore"></td><td><button type="button" onclick="remTd(this)">-</button></td>');
                $("#trasferte").append("</tr>");
            }else
            {
                alert('Valore massimo raggiunto.');
            }
        }
        function remTd(){//fix needed
            $(this).parent("tr").remove();
        }
    </script>
    </body>
    </html>

