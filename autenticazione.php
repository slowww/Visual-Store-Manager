<?php
/*$conn= new mysqli("localhost","root","","vsm_db");
if ($conn->connect_error) {
    die("Connessione col db non riuscita: " . $conn->connect_error);
}*/


if(isset($_POST["submit"]))
{
    $id_dip=$_POST["user"]; //nome.cognome dipendente
    $pwd_dip=$_POST["pwd"];

    /*query sql per verificare che i dati inseriti dal dipendente corrispondano a quelli presente nel db*/

    $stmt = $conn->prepare("SELECT id_dip,pwd_dip FROM dipendenti WHERE id_dip=$id_dip AND pwd_dip=$pwd_dip;");
    $stmt->execute();
    $result = $stmt->get_result();

    if($result<1)
    {
        /*echo "<script>alert('Operazione effettuata correttamente!')</script>";
    }else
    {*/
        die("<script>alert('Non è stato possibile effettuare l&#39;operazione')</script>");
    }




}






?>