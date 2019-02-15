<?php $conn = mysqli_connect("localhost","root","", "vsm_db");

$email = $_POST["email"];
$pwd = $_POST["outPwd"];



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

$query = "SELECT nome_dip,cogn_dip FROM dipendenti WHERE id_dip = 'massimo.benedetti@insmercato.it' AND pwd_dip = 'massimopwd'";
//$query .= "WHERE id_dip = 'massimo.benedetti@insmercato.it' AND pwd_dip = 'massimopwd'";
$result=mysqli_query($conn, $query);


if ($result=mysqli_query($conn,$query))
  {
    $row=mysqli_fetch_array($result);
    echo $row['nome_dip'] . " " . $row['cogn_dip'];
    mysqli_free_result($result);
  }

mysqli_close($conn);

/*
$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_row($result))
{
  print_r($row);
}


mysqli_close($conn);?>*/
?></h2>

<select>
  <?php
    $query="SELECT "
  
  ?>
</select>






</body>
</html>




<?php




?>