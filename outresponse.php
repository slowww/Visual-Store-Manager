<?php
session_start();
require 'connection.php';
require("user.php");
?>

<html>

<head>
  <style>
      body {
          background-color: #4169E1;
          font-family: sans-serif;
      }
    </style>
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

<form action="searchmod" method="POST">
<table>
<tr><td>CDC</td><td>MODELLO</td><td>MESE</td></tr>
<tr>
  <td>
    <select required name="cdc">
      <?php
      $stmt=$conn->prepare("SELECT cdc,citta_cdc FROM cdc;");
      $stmt->execute();
      $result=$stmt->get_result();
      if ($result->num_rows > 0) {
          while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
              echo $row['cdc'] . " " . $row['citta_cdc'];
              
          }
      }
      ?>
    </select>
  </td>
  <td>
    <select name="outmod">
      <option>INCASSI&ORE</option>
      <option>MOD.54 (rifiuti)</option>
      <option>MOD.23 (manutenzioni)</option>
      <option>MOD.140 (differenze di carico)</option>
    </select>
  </td>
  <td>
  <input type="month" value="<?php echo Date("Y"); ?>" name="outmese">
  </td>
</tr>
<tr>
  <td><input type="submit" value="RICERCA" name="ricerca"></td>
</tr>


<?php mysqli_close($conn); ?>



</body>
</html>