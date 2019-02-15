<?php $conn = mysqli_connect("localhost","root","", "vsm_db");

$email = $_POST["email"];
$pwd = $_POST["outPwd"];

//echo $email; debug
//echo $pwd; debug


if(!$conn)
  {
    echo '<script language="javascript">';
    echo 'alert("Connessione col database non riuscita!")';
    echo '</script>';
    exit;
  }

  mysqli_select_db($conn,"vsm_db");

?>

<html>

<head>
  <style>
             html { font-family: sans-serif; background-color: #4169E1;}
    </style>
</head>
<body>

<h2>BENVENUTO, <?php 

$query = "SELECT nome_dip,cogn_dip FROM dipendenti WHERE id_dip = '$email' AND pwd_dip = '$pwd'";

//echo $query; debug


if ($result=mysqli_query($conn,$query))
  {
    $row=mysqli_fetch_array($result);
    echo $row['nome_dip'] . " " . $row['cogn_dip'];
    mysqli_free_result($result);
  }



/*
$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_row($result))
{
  print_r($row);
}


mysqli_close($conn);?>*/
?></h2>

<table>
<tr><td>CDC</td><td>MODELLO</td><td>MESE</td></tr>
<tr>
  <td>
    <select>
      <?php
        $query="SELECT cdc, citta_cdc FROM cdc";

        if ($result=mysqli_query($conn,$query))
        {
            while($row = mysqli_fetch_array($result)){ 
              
                  echo "<option>" . $row['cdc'] . "-" . $row['citta_cdc'] . "</option>";
            }      
        } 
      
      ?>
    </select>
  </td>
  <td>
    <select>
      <option>INCASSI&ORE</option>
      <option>MOD.54 (rifiuti)</option>
      <option>MOD.23 (manutenzioni)</option>
      <option>MOD.140 (differenze di carico)</option>
    </select>
  </td>
  <td>
  <input type="month" value="<?php echo Date("Y"); ?>">
  </td>


<?php mysqli_close($conn); ?>



</body>
</html>




<?php




?>