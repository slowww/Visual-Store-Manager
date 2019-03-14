<?php
$op=$_POST["op"];
$cdc=$_POST["cdc"];
$cdcPwd=$_POST["cdcPwd"];

//controllare credenziali ed eventualmente restituire messaggio d'errore

/*$query="SELECT cdc, pwd_cdc FROM cdc WHERE cdc = '$cdc' AND pwd_cdc = '$cdcPwd'";

if (!$result=mysqli_query($conn,$query))
{
  $_GET["queryresult"]="false";
  header('Location: ' . $_SERVER['HTTP_REFERER']);//redirect alla pag precedente
} 
else
{    */ 
          


    if(isset($op)){

            switch ($op) {
              case 'incassiore':
                include 'incassiorecdc.php';
                break;
              case 'differenze':
                include 'differenzecdc.php';
                break;
              case 'rifiuti':
                include 'rifiuticdc.php';
                break;
              case 'manutenzioni':
                include 'manutenzcdc.php';
                break;
              /*default:
                echo "Selezionare un'operazione!"//meglio gestirla a livello client con Javascript nella pagina
                break;*/
            }
    }
//}