<?php
session_start();
require 'connection.php';
require("user.php");
?>

<html>

<head>
    <link href="style.css" rel="stylesheet" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
</head>
<body>
<?php include 'backtomenu.html'; ?>

<h2>BENVENUTO,

    <?php
    if(isset($_SESSION["access"]))//se è gia settata la sessione utente (ovvero se l'utente si è loggato)
    {
        $access = unserialize($_SESSION['access']);
        $id_dip = $access->getUsername();
        $pwd_dip = $access->getPwd();
        //DA FARE CON AJAX CON DOCUMENT.READY
        //GET REQUEST VERSO DIP.PHP - CONTROLLO JSON E SE PRESENTE NOME E COGNOME OK e LI MOSTRO ALTRIMENTI JSON(ERROR)
        $stmt = $conn->prepare("SELECT nome_dip,cogn_dip FROM dipendenti WHERE id_dip = ? AND pwd_dip = ?;");
        $stmt->bind_param("ss",$id_dip,$pwd_dip);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                echo $row['nome_dip'] . " " . $row['cogn_dip'];

            }
        }
    }
    ?>
</h2>


<table>
<tr><td>CDC</td><td>MODELLO</td><td>MESE</td><td>ANNO</td></tr>
<tr>
  <td>
    <select required id="cdc">
      <?php
      $stmt=$conn->prepare("SELECT cdc,citta_cdc FROM cdc;");
      $stmt->execute();
      $result=$stmt->get_result();
      if ($result->num_rows > 0) {
          while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
              echo "<option value=".$row['cdc'].">".$row['cdc'] . " " . $row['citta_cdc']."</option>";
              
          }
      }
      ?>
    </select>
  </td>
  <td>
    <select id="mod">
      <option value="io">INCASSI&ORE</option>
      <option value="manutenz">MOD.23 (manutenzioni)</option>
      <option value="diff">MOD.140 (differenze di carico)</option>
    </select>
  </td>
  <td>
  <select id="mese">
      <option value="1">GENNAIO</option>
      <option value="2">FEBBRAIO</option>
      <option value="3">MARZO</option>
      <option value="4">APRILE</option>
      <option value="5">MAGGIO</option>
      <option value="6">GIUGNO</option>
      <option value="7">LUGLIO</option>
      <option value="8">AGOSTO</option>
      <option value="9">SETTEMBRE</option>
      <option value="10">OTTOBRE</option>
      <option value="11">NOVEMBRE</option>
      <option value="12">DICEMBRE</option>
  </select>
  </td>
    <td>
        <select id="anno">
        </select>
    </td>
</tr>
<tr>
    <td><button onclick="ricercamod()">RICERCA</button></td>
   <!-- <td id="chartcheckbox"><label>Mostra grafico</label><input type="checkbox" id="showChart"> </td>-->
</tr>
</table>



<div id="result"></div>

<div id="pop"></div>

<div id="chartcontainer"><canvas id="myChart" width="80" height="50"></canvas></div>


<?php mysqli_close($conn); ?>



</body>
</html>



<script>
    var min = new Date().getFullYear(),
    max = min - 2,
    select = document.getElementById('anno');

    for (var i = max; i<=min; i++){
        var opt = document.createElement('option');
        opt.value = i;
        opt.innerHTML = i;
        select.appendChild(opt);
    }
</script>

<script>
    function ricercamod()
    {
        $("#chartcheckbox").css('visibility','hidden');
        $("#pop").empty();
        /*switch ($("#mod").val()) {

        CONTROLLO MODULO SELEZIONATO
            
        }*/

        $("#result").empty();

        var cdc = $("#cdc").val();
        var mese = $("#mese").val();
        var anno = $("#anno").val();
        const xlab=[];
        const ylab=[];
        $.ajax({
            type: 'GET',
            url: 'http://localhost/Visual_store_manager/io_script.php?cdc='+cdc+'&mese='+mese+'&anno='+anno,

            success: function (data) {
                if(data.msg)
                {
                    alert(data.msg);
                }else {
                    console.log(data);
                    $("#result").append('<table id="result_table"><thead><tr><th>ID MODELLO</th><th>DATA</th></tr></thead>');
                    $.each(data, function (i, dato) {
                        $("#result_table").append('<tr><td class="id_mod">' + dato.id_mod_io + '</td><td class="data_mod">' + dato.data_io + '</td></tr>');

                        xlab.push(dato.nr_sett);
                        ylab.push(dato.incasso);

                    });
                    $("#result").append('</table>');
                    createGraph(xlab,ylab);
                    $("#chartcheckbox").css('visibility','visible');
                }


            }
        });
    }
</script>

<script>
    /*$(document).ready(function(){
            if($("#showChart").is(":checked"))

                $('#chartcontainer').css("display","initial");
            else
                $('#chartcontainer').css("display","none");


    });*/
</script>



<!--
chiedo all'utente dato X (es. incasso)
chiedo all'utente dato Y (es. straordinario)
con una select (?)

effettuo ajax (clone di ricercamod() ) per reperire tutti i dati (select * ...)
dentro success:
metto switch (?) per attribuire ad una prima variabile quali valori dovranno essere rappresentati dall asse x
faccio un altro switch che fa la stessa cosa per l'asse y

dentro each():
data.datox -> pusho tutto in array per contenere valori x
data.datoy -> idem per y

chiamo funzione createGraph e gli passo (arrayx, arrayy)


https://www.youtube.com/watch?v=5-ptp9tRApM
-->




<script>
    function createGraph(xlabels,ylabels) {
        var ctx = document.getElementById('myChart').getContext('2d');

        var myChart = new Chart(ctx, {
            type: 'line',
            responsive: true,
            maintainAspectRatio: false,
            data: {
                labels: xlabels,
                datasets: [{
                    label: 'Variazione incasso su base settimanale',
                    data: ylabels,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)'
                    ],
                    borderWidth: 1
                }]
            }
        });

    }

</script>











<script>

//creazione POPUP
    $(document).ready(function() {
        $("#pop").empty();
        $("#mod_table").empty();


        $("#result").on("click", ".id_mod", function () {
            $("#pop").empty();
            var id_mod = $(this).text();
            console.log(id_mod);

            $.ajax({
                type: 'GET',
                url: 'http://localhost/Visual_store_manager/io_script.php?id_mod=' + id_mod,
                dataType: "json",
                success: function (data) {

                    if (data.msg) {

                        alert(data.msg);
                    } else {

                        /*$("#pop").css('visibility','visible');
                        $("#pop").dialog({
                            closeText: "X",
                            close : function(event, ui) {
                                $("#pop").html("");
                            }
                        }).position({
                            my: "right+170",
                            at: "top+5%",
                            of: "#result_table"
                        });*/


                        $("#pop").append('<table id="mod_table" border=1>');
                        $.each(data, function (i, dato) {
                            $("#mod_table").append('<tr><td>ID_MODELLO</td><td>' + dato.id_mod_io + '</td></tr>');
                            $("#mod_table").append('<tr><td>DATA</td><td>' + dato.data_io + '</td></tr>');
                            $("#mod_table").append('<tr><td>NR. SETT</td><td>' + dato.nr_sett + '</td></tr>');
                            $("#mod_table").append('<tr><td>Tirocinio</td><td>' + dato.tiro + '</td></tr>');
                            $("#mod_table").append('<tr><td>Effettive</td><td>' + dato.eff + '</td></tr>');
                            $("#mod_table").append('<tr><td>Riduzione</td><td>' + dato.rid + '</td></tr>');
                            $("#mod_table").append('<tr><td>Ferie</td><td>' + dato.ferie + '</td></tr>');
                            $("#mod_table").append('<tr><td>Permessi</td><td>' + dato.pr + '</td></tr>');
                            $("#mod_table").append('<tr><td>TOTALE</td><td>' + dato.tot + '</td></tr>');
                            $("#mod_table").append('<tr><td>Malattia</td><td>' + dato.mal + '</td></tr>');
                            $("#mod_table").append('<tr><td>Maternità</td><td>' + dato.mat + '</td></tr>');
                            $("#mod_table").append('<tr><td>Varie</td><td>' + dato.varie + '</td></tr>');
                            $("#mod_table").append('<tr><td>ORGANICO</td><td>' + dato.org + '</td></tr>');
                            $("#mod_table").append('<tr><td>In entrata</td><td>' + dato.entr + '</td></tr>');
                            $("#mod_table").append('<tr><td>In uscita</td><td>' + dato.usc + '</td></tr>');
                            $("#mod_table").append('<tr><td>Straordinario</td><td>' + dato.str + '</td></tr>');
                            $("#mod_table").append('<tr><td>Incasso</td><td>' + dato.incasso + '</td></tr>');
                            $("#mod_table").append('<tr><td>Resa</td><td>' + dato.resa + '</td></tr>');

                        });
                        $("#pop").append('</table>');

                    }
                }
            });
        });
    });



</script>