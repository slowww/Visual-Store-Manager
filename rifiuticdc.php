<html>
<head>
  <style>

  html { font-family: sans-serif; background-color: #4169E1;}

  table {
    width: 50vw;
    margin: auto;
  }

  [type="text"],[type="number"],select{
  width: 100%;
  }

  [value="INVIA"] {
    
    width:100px; 
    height:50px;
    float: right;
    margin-right: 370px;
    margin-top: 50px;
  }

  </style>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

</head>

<body>
<h2>FORMULARIO RIFIUTI</h2>
<p>D.Lgs. del 5-2-97 n°22 (Art.15 e successive modifiche ed integrazioni) D.M. del 1-4-98 n°145
  Direttiva ministero ambiente 9-4-2002.
</p>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
  <table border="1">
    <tr><td colspan="2">Data: <?php echo date("d/m/Y")?> Ora: <?php echo date("h:i:sa")?></td></tr><!--cambiare formato ora-->
    <tr><td colspan="2">Produttore/detentore: In's Mercato S.p.A. <!--dati societari--></td></tr>
    <tr><td colspan="2">Destinatario: B&M S.r.l. - Via Emilio Brasca, 137 Trezzo sull'Adda(MI)
            C.F. 03431030166 - N°Aut./Albo: 4355/2016 del 17/5/2016</td></tr>
    <tr><td>Trasportatore:</td>
      <td>
      <select name="trans">
        <option selected></option>
        <?php
          /*scorre la tabella dei trasportatori sul database
          recupera la ragione sociale e per ciascuna crea una <option>

          alla selezione della option, verranno stampati tutti i dati relativi al trasportatore
          */
        ?>
      </select></td></tr>
      <tr><td>Annotazioni: </td><td><input type="text" name="annotazioni"></td></tr>

      <tr><td>Trasporto sottoposto ad/rid </td><td><input type="checkbox"></td></tr>
      <tr><td>Carta e cartone (cod. Europeo 15.01.01)</td><td><input type="checkbox" name="cartone"></td></tr>
      <tr><td>Imballaggi in plastica (cod. Europeo 15.01.02)</td><td><input type="checkbox" name="plast"></td></tr><!--SE SI SELEZIONA UNO, L'ALTRO SI DESELEZIONA!!!!-->
      <tr><td>Stato fisico</td><td><select name="stato">
                              <option selected></option>
                               <option value="uno">1</option>
                               <option value="due">2</option>
                               <option value="tre">3</option>
                               <option value="quattro">4</option>
                            </select></td></tr>
                  
      <tr><td>Quantità (in kg): </td><td><input type="number" name="qty"></td></tr>
      <tr><td>Destinazione del rifiuto: </td><td><select name="destrif">
                              <option selected></option>
                               <option value="rec">Recupero</option>
                               <option value="smal">Smaltimento</option>
                            </select>
                          <input type="text" name="destrifsigla" maxlength="3" size="3"></td></tr>   
      <tr><td>Numero di contenitori: </td><td><input type="number" name="ncont" maxlength="2" size="2"></td></tr>
      <tr><td>Caratteristiche di pericolo: </td><td><input type="text" name="pericolo"></td></tr>
      <tr><td>Caratteristiche chimico-fisiche: </td><td><input type="text" name="chim"></td></tr>
      <tr><td>Percorso (se diverso dal più breve): </td><td><input type="text" name="percorso"></td></tr>
      <tr><td>Targa automezzo: </td><td><input type="text" name="targa"></td></tr>
      <tr><td>Targa rimorchio: </td><td><input type="text" name="rimo"></td></tr>
      <tr><td>Cognome e nome conducente: </td><td><input type="text" name="trasportatore"></td></tr>
      <tr><td>Data inizio trasporto: <input type="submit" value="DATA" onclick="getDate()"></td><td id="datatrasp"></td></tr>
      <tr><td>Ora inizio del trasporto: <input type="submit" value="ORA" onclick="getHour()"></td><td id="oratrasp"></td></tr>
      <tr><td>ID&password compilatore: </td><td><input type="text" name="user" placeholder="id"><input type="password" name="pwd" placeholder="password"></td></tr>
  </table>
<input type="submit" value="INVIA">
</form>


<script>

  function getDate()
  {
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth() + 1; //January is 0!

    var today = dd + '/' + mm + '/' + yyyy;

    $("datatrasp").val(today);
  }

  function getHour()
  {
    var today = new Date();
    var hh = today.getHours();
    var mm = today.getMinutes();

    var today = hh + ':' + mm;

    $("oratrasp").val(today);
  }
</script>
</body>
</html>


<?php
include("autenticazione.php");
?>