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
<form>
  <table border="1">
    <tr><td>Data: <?php echo date("d/m/Y")?></td><td>Ora: <?php echo date("h:i:sa")?></td></tr><!--cambiare formato ora-->
    <tr><td>Mittente: In's Mercato S.p.A. <!--dati societari--></td></tr>
    <tr><td>Trasportatore:
      <select name="trans">
        <option selected></option>
        <?php
          /*scorre la tabella dei trasportatori sul database
          recupera la ragione sociale e per ciascuna crea una <option>

          alla selezione della option, verranno stampati tutti i dati relativi al trasportatore
          */
        ?>
      </select></td></tr>
      <tr><td>Trasporto sottoposto ad/rid <input type="checkbox"></td>
          <td>Cartone<input type="checkbox" name="cartone"></td>
          <td>Plastica<input type="checkbox" name="plast"></td><!--SE SI SELEZIONA UNO, L'ALTRO SI DESELEZIONA!!!!-->
          <td>Quantità (in kg): <input type="number" name="qty"></td></tr>
      <tr><td>Nome trasportatore: <input type="text" name="driver"></td></tr>
      <tr><td>Ora inizio del trasporto <input type="time" name="oratrasp"></td></tr>

  </table>
<input type="submit" value="INVIA">
</form>

</body>
</html>
