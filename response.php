<?php
$op=$_POST["op"];

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
}/*else
      {
        $conn = mysqli_connect("localhost", "vsm_db");

        $email = $_POST["email"];
        $pwd = $_POST["outPwd"];
      }?>

        <html>

        <head>
        </head>
        <body>
        <?php
        if(!$conn)
          {
            echo '<script language="javascript">';
            echo 'alert("Connessione col database non riuscita!")';
            echo '</script>';
            exit;
          }
        ?>

        <h2>BENVENUTO, <?php 
        /*QUERY PER RICERCARE NOME UTENTE IN BASE ALLA MAIL
        $tab = "dipendenti";

        mysqli_select_db($conn,$tab);

        $query = "SELECT nome_dip, cogn_dip FROM dipendenti";
        $query .= "WHERE id_dip = " . $email . " AND " . " pwd_dip = " . $pwd;

        $result=mysqli_query($conn,$query);

        echo $result;

        mysqli_close($conn);?></h2>






        </body>
        </html>




 ?>*/
