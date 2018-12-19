<?php

if((isset($cdc) && isset($cdcpwd))//GESTIONE OPERAZIONI NEGOZI
{
      if(isset($op))//visualizzazione del form relativo all'operazione richiesta
      {
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
            include 'manutenzionicdc.php'
            break;
          default:
            echo "Selezionare un'operazione!"//meglio gestirla a livello client con Javascript nella pagina
            break;
        }
      }
}

//SE è STATO EFFETTUATO L'ACCESSO CON I DATI DEGLI ESTERNI
//VERRA VISUALIZZATA UNA TABELLA CON L'ELENCO DEI MODELLI (DI UN TIPO)
//FORMATO TABELLA: Id modello - Data
//CLICCANDO SULL'ID VIENE VISUALIZZATO IL MODELLO IN UNA FINESTRA A PARTE (?)
 ?>
