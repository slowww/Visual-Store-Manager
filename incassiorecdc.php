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
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
  <table border="1">
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
      <td> <?php $nsett = date("W"); ?></td>
      <td><input type="number" maxlength="3" size="3" name="tiro"></td>
      <td><input type="number" maxlength="3" size="3" name="eff"></td>
      <td><input type="number" maxlength="1" size="1" name="rid"></td>
      <td><input type="number" maxlength="3" size="3" name="fe"></td>
      <td><input type="number" maxlength="3" size="3" name="pr"></td>
      <td><input type="number" maxlength="3" size="3" name="tot">
      <input type="submit" onclick="tot()"></td>
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

//$(document).ready(function(){
    function tot()
    {

      var x = $("#primo input").value;

      //var tot = parseInt(document.getElementsByName("tot").value);

      //tot += x;
      alert(x);
      //document.getElementsByName("tot").innerHTML = x;

    });}

  //});


</script>
</body>

</html>

<?php

/*$dati_io = array('sett' => $_POST['sett'], ... );//verificare sensatezza della soluzione

$sett = $_POST['sett'];
$tiro = $_POST['tiro'];
$eff_lav = $_POST['eff'];
$rid = $_POST['rid'];
$fe = $_POST['fe'];
$pr = $_POST['pr'];
$tot = $_POST['tot'];
$mal = $_POST['mal'];
$mat = $_POST['mat'];
$varie = $_POST['varie'];
$org = $_POST['org'];
$ing = $_POST['in'];
$out = $_POST['out'];
$str = $_POST['str'];
$inc = $_POST['inc'];
$resa = $_POST['resa'];

if(!isset($_POST["submit"]))//se non sono stati compilati tutti i campi restituisci un messaggio d'errore
{
  echo '<script language="javascript">';
  echo 'alert("Dati inseriti incompleti!")';
  echo '</script>';
}else {
  //scrivi i dati sulla relativa tabella nel SQLiteDatabase
  //OVVERO:
$connect = mysqli_connect(/*hostname,username,password*);
  if(!$connect)
  {
    echo '<script language="javascript">';
    echo 'alert("Connessione col database non riuscita!")';
    echo '</script>';
    exit;
  }

mysqli_select_db($connect,/*nome tabella*);

  $insert = "INSERT INTO Incassiore (sett,tiro,eff_lav,rid,fe,pr,tot,mal,mat,varie,org,ing,out,str,inc,resa)";
  $insert .= "VALUES ('$sett','$tiro','$eff_lav','$rid','$fe','$pr','$tot','$mal','$mat','$varie','$org','$ing','$out','$str','$inc','$resa')";

  if(!$insert)
  {
    echo "<script>";
    echo "alert('Inserimento fallito!')";
    echo "</script>";
    exit();
  }else {
    echo echo "<script>";
    echo "alert('Inserimento avvenuto correttamente!')";
    echo "</script>";
    mysqli_close($connect);
  }

}*/

?>
