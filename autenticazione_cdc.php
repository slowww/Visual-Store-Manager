<?php
if(isset($_POST["submit"]))
{
    $cdc=$_POST["cdc"]; //nome.cognome dipendente
    $cdc_pwd=$_POST["cdcPwd"];

    /*query sql per verificare che i dati inseriti dal dipendente corrispondano a quelli presente nel db*/

    $stmt = $conn->prepare("SELECT cdc,cdc_pwd FROM dipendenti WHERE cdc=$cdc AND cdc_pwd=$cdc_pwd;");
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
