<?php

if((isset($cdc) && isset($cdcpwd))//se dati non impostati
{
      if(isset($op))
      {
        switch ($op) {
          case 'incassiore':
            include 'incassiore.php';
            break;
          case 'differenze':
            include 'differenze.php';
            break;
          case 'rifiuti':
            include 'rifiuti.php';
            break;
          case 'manutenzioni':
            include 'manutenzioni.php'
            break;
          default:
            echo "Selezionare un'operazione!"
            break;
        }
      }
}
 ?>
