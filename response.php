<?php
$op=$_POST["op"];
$cdc=$_POST["cdc"];
$cdcPwd=$_POST["cdcPwd"];

include 'autenticazione_cdc.php';

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
              default:
                  header('Location: index.php?errmsg=1');
                  break;
            }
    }
//}