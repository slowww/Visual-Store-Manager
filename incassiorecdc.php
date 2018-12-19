<html>
<head>

<style>

html { font-family: sans-serif; background-color: #4169E1;}

table {
  width: 90vw;
}

</style>

</head>


<body>
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
    <tr>
      <td> <?php echo date("W"); ?></td>
      <td><input type="number" maxlength="3" size="3"></td>
      <td><input type="number" maxlength="3" size="3"></td>
      <td><input type="number" maxlength="1" size="1"></td>
      <td><input type="number" maxlength="3" size="3"></td>
      <td><input type="number" maxlength="3" size="3"></td>
      <td><input type="text" disabled="disabled"></td>
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
      <td><input type="number" maxlength="3" size="3"></td>
      <td><input type="number" maxlength="3" size="3"></td>
      <td><input type="number" maxlength="3" size="3"></td>
      <td><input type="number" maxlength="3" size="3"></td>
      <td><input type="number" maxlength="3" size="3"></td>
      <td><input type="number" maxlength="3" size="3"></td>
      <td><input type="text" disabled="disabled"></td>
    </tr>
    <tr>
      <td>Incasso</td>
      <td>Resa oraria</td><!--verificare se si puo calcolare attraverso i dati inseriti-->
    </tr>
    <tr>
      <td><input type="number" maxlength="6" size="6"></td>
      <td><input type="number" maxlength="3" size="3"></td>
      <td><input type="submit" value="INVIA" name="submit"></td>
    </tr>


  </table>



</body>

</html>
<?php

if(!isset($_POST["submit"]))//se non sono stati compilati tutti i campi restituisci un messaggio d'errore
{

}else {
  //scrivi i dati sulla relativa tabella nel SQLiteDatabase
  //OVVERO:
$connect = mysqli_connect(/*hostname,username,password*/);
  if(!$connect)
  {
    echo '<script language="javascript">';
    echo 'alert("Connessione col database non riuscita!")';
    echo '</script>';
    exit;
  }

  mysqli_select_db($connect,/*nome tabella*/)

  $insert = INSERT INTO



}

?>
