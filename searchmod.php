<?php

$cdc=$_POST["cdc"];
$outmod=$_POST["outmod"];
$outmese=$_POST["outmese"];


$query="SELECT id_mod, data_mod FROM modelli WHERE cdc_fk='$cdc' AND descr_mod='$outmod'" //AND il mese della data del modello è uguale a $outmese

if ($result=mysqli_query($conn,$query))
  {
    //voglio che l'output venga però rediretto sulla pagina precedente (outresponse.php)
    echo "<table>";
    echo "<tr><td>ID MODELLO</td><td>DATA</td></tr>";
        while($row=mysqli_fetch_array($result))
        {
            echo "<tr><td>" . $row['id_mod'] . "</td><td>" . $row['data_mod']"</td></tr>";
            //l'id deve essere un hyperlink attraverso il quale viene generato un pdf formattato e stampabile
        }
    echo "</table>";

    mysqli_free_result($result);
  }




?>