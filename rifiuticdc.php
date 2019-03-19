<?php

$conn= new mysqli("localhost","root","","vsm_db");
if ($conn->connect_error) {
    die("Connessione col db non riuscita: " . $conn->connect_error);
}


?>

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
<?php include 'backtomenu.html'; ?>




<h2>FORMULARIO RIFIUTI</h2>
<p>D.Lgs. del 5-2-97 n°22 (Art.15 e successive modifiche ed integrazioni) D.M. del 1-4-98 n°145
  Direttiva ministero ambiente 9-4-2002.
</p>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
  <table border="1">
    <tr><td colspan="2">Data: <?php echo date("d/m/Y")?> Ora: <?php echo date("h:i:sa")?></td></tr><!--cambiare formato ora-->
    <tr><td colspan="2">Produttore/detentore: In's Mercato S.p.A.
            <?php $stmt = $conn->prepare("SELECT cdc FROM cdc WHERE cdc=?;");
            $stmt->bind_param('s',$GLOBALS['cdc']);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                        echo "<option>" . $row['cdc'] . "</option>";
                    }
                }else{
                    echo "#no_data#";
                }?>

        </td></tr>
    <tr><td colspan="2">Destinatario:
            <select name="depo">
                <?php $stmt = $conn->prepare("SELECT p_iva,nome_ditta,citta_ditta,ind_ditta FROM ditta_esterna;");
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                        echo "<option>P.I.: " . $row['p_iva'] . " - " . $row['nome_ditta'] . " - " . $row['citta_ditta'] . " - " . $row['ind_ditta'] ."</option>";
                    }
                }else{
                    echo "#no_data#";
                }


                ?>
            </select>
            </td></tr>
    <tr><td>Trasportatore:</td>
      <td>
          <select name="trans">
              <?php $stmt = $conn->prepare("SELECT p_iva,nome_ditta,citta_ditta,ind_ditta FROM ditta_esterna;");
              $stmt->execute();
              $result = $stmt->get_result();

              if ($result->num_rows > 0) {
                  while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                      echo "<option>P.I.: " . $row['p_iva'] . " - " . $row['nome_ditta'] . " - " . $row['citta_ditta'] . " - " . $row['ind_ditta'] ."</option>";
                  }
              }else{
                  echo "#no_data#";
              }


              ?>
          </select>
      </td></tr>
      <tr><td>Annotazioni: </td><td><input type="text" name="annotazioni"></td></tr>

      <tr><td>Trasporto sottoposto ad/rid </td><td><input type="checkbox" name="adrid"></td></tr>
      <tr><td>Carta e cartone (cod. Europeo 15.01.01)</td><td><input type="checkbox" name="cartone"></td></tr>
      <tr><td>Imballaggi in plastica (cod. Europeo 15.01.02)</td><td><input type="checkbox" name="plast"></td></tr><!--SE SI SELEZIONA UNO, L'ALTRO SI DESELEZIONA!!!!-->
      <tr><td>Stato fisico</td><td><select name="statofisico">
                              <option selected></option>
                               <option value="uno">1</option><!--necessario name?-->
                               <option value="due">2</option>
                               <option value="tre">3</option>
                               <option value="quattro">4</option>
                            </select></td></tr>
                  
      <tr><td>Quantità (in kg): </td><td><input type="number" name="qty"></td></tr>
      <tr><td>Destinazione del rifiuto: </td>
                            <td><select name="destrif">
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
      <tr><td>Data inizio trasporto: </td><td><input type="text" name="oratrasp" value="<?php echo date('d/m/Y')?>"></td></tr>
      <tr><td>Ora inizio del trasporto: </td><td><input type="text" name="datatrasp" value="<?php echo date('h:i:sa')?>"></td></tr>
      <tr><td>ID&password compilatore: </td><td><input type="text" name="user" placeholder="id" required><input type="password" name="pwd" placeholder="password" required></td></tr>
  </table>
<input type="submit" value="INVIA">
</form>


</body>
</html>



<?php
include("autenticazione.php");
?>




<?php
$stmt->close();
$conn->close();
?>
?>