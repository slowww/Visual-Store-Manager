<?php
session_start();
require 'connection.php';
require("user.php");
?>

<html>

<head>
    <link href="style.css" rel="stylesheet" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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
<tr><td>CDC</td><td>MODELLO</td><td>MESE</td></tr>
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
</tr>



<div id="result"></div>




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
        switch ($("#mod").val()) {
            
        }

        $("#result").empty();

        var cdc = $("#cdc").val();
        var mese = $("#mese").val();
        var anno = $("#anno").val();

        $.ajax({
            type: 'GET',
            url: 'http://localhost/Visual_store_manager/io_script.php?cdc='+cdc+'&mese='+mese+'&anno='+anno,

            success: function (data) {
                if(data.msg)
                {
                    $("#result").append(data.msg);
                }else {
                    console.log(data);
                    $("#result").append('<table id="result_table" border=1><tr><td>ID MODELLO</td><td>DATA</td></tr>');
                    $.each(data, function (i, dato) {
                        $("#result_table").append('<tr><td class="id_mod">' + dato.id_mod_io + '</td><td class="data_mod">' + dato.data_io + '</td></tr>');

                    });
                    $("#result").append('</table>');
                }


            }
        });
    }
</script>

<script>

    $("#result_table .id_mod").addEventListener("click", function () {

        var id_mod = $(this).text();

        $.ajax({
            type: 'GET',
            url: 'http://localhost/Visual_store_manager/io_script.php?id_mod='+id_mod,

            success: function (data) {
                if(data.msg)
                {
                    $("#result").append(data.msg);
                }else {
                    console.log(data);
                    $("#result").append('<table id="result_table" border=1><tr><td>ID MODELLO</td><td>DATA</td></tr>');
                    $.each(data, function (i, dato) {
                        $("#result_table").append('<tr><td class="id_mod">' + dato.id_mod_io + '</td><td class="data_mod">' + dato.data_io + '</td></tr>');

                    });
                    $("#result").append('</table>');
                }


            }
        });



    })

</script>