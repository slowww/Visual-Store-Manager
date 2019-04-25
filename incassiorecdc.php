<?php
session_start();
require 'connection.php';
require("user.php");
?>

<html>
<head>


<style>

html { font-family: sans-serif; background-color: #4169E1;}

table {
  width: 90vw;
}

</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

</head>


<body>
  <?php include 'backtomenu.html'; ?>
  <?php include 'header.php'; ?>
  <form name="ic" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
  <table>
    <tr>
      <td>Settimana numero</td>
      <td>Ore Tirocinio</td>
      <td>Ore eff. lavorate</td>
      <td>Riduz. oraria</td>
      <td>Ferie</td>
      <td>Permessi retr.</td>
      <td>TOT</td><!--riduz oraria + ferie + pr-->
    </tr>
    <tr id="primo">
      <td> <?php echo date("W"); ?></td>
      <td><input type="number" maxlength="3" size="3" name="tiro"></td>
      <td><input type="number" maxlength="3" size="3" name="eff"></td>
      <td><input type="number" maxlength="1" size="1" name="rid"></td>
      <td><input type="number" maxlength="3" size="3" name="fe"></td>
      <td><input type="number" maxlength="3" size="3" name="pr"></td>
      <td><input maxlength="3" size="3" id="tot" readonly>
          <button type="button" onclick="total()">CALCOLA</button>
      </td>
    </tr>
    <tr>
      <td>Malattia</td>
      <td>Maternità</td>
      <td>Varie</td>
      <td>ORGANICO</td>
      <td>In entrata</td>
      <td>In uscita</td>
      <td>STRAORDINARIO</td><!--verificare calcolo-->
    </tr>
    <tr>
      <td><input type="number" maxlength="3" size="3" name="mal"></td>
      <td><input type="number" maxlength="3" size="3" name="mat"></td>
      <td><input type="number" maxlength="3" size="3" name="varie"></td>
      <td><input type="number" maxlength="3" size="3" name="org"></td>
      <td><input type="number" maxlength="3" size="3" name="in"></td>
      <td><input type="number" maxlength="3" size="3" name="out"></td>
      <td><input type="text" disabled="disabled" name="str"></td>
    </tr>
    <tr>
      <td>Incasso</td>
      <td>Resa oraria</td><!--verificare se si puo calcolare attraverso i dati inseriti-->
    </tr>
    <tr>
      <td><input type="number" maxlength="6" size="6" name="inc"></td>
      <td><input type="number" maxlength="3" size="3" name="resa"></td>
      <td><input type="submit" value="INVIA" name="submit"></td>
    </tr>


  </table>

</form>




<script>

    function total() {
    var total=0;
    var value=0;
        $("#primo [type='number']").each(
            function () {
                value= parseFloat($(this).val())
                console.log("cons:"+value);
                total+=value;
            }
        )

        $("#tot").val(total);
    }


</script>
</body>

</html>