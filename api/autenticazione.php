<?php
session_start();
include_once('../config/connection.php');
require("../classes/user.php");

$user=$_POST['user'];
$pwd=md5($_POST['pwd']);
$accesstype=$_POST['accesstype'];



if(isset($user)&&isset($pwd)&&isset($accesstype))
{
    $us_obj = new User ($user,$pwd);
    switch ($accesstype) {
        case "negozio":
            mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
            $stmt = $conn->prepare("SELECT * FROM cdc WHERE cdc=? AND cdc_pwd=?");
            $stmt->bind_param("ss", $user, $pwd);
            $stmt->execute();
            $result = $stmt->get_result();



            if ($result->num_rows == 1) {
                //se login ok, istanzio sessione
                $_SESSION['access']=serialize($us_obj);
                switch ($_POST['op']) {
                    case 'incassiore':
                        header('Location: ../cdc/incassiorecdc.php');
                        break;
                    case 'differenze':
                        header('Location: ../cdc/diffcdc.php');
                        break;
                    case 'manutenzioni':
                        header('Location: ../cdc/manutenzcdc.php');
                        break;
                }//inner switch
            } else {
                header('Location: ../index.php?errmsg=error');
            }
            $stmt->close();
            $conn->close();
            break;

        case "esterno":
            mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
            $stmt = $conn->prepare("SELECT * FROM dipendenti WHERE id_dip=? AND pwd_dip=? AND cdc_fk is null;");
            $stmt->bind_param("ss", $user, $pwd);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows == 1) {

                $us_obj = new User ($user,$pwd);
                $_SESSION['access']=serialize($us_obj);
                header('Location: ../external/esterno.php');
            } else {
                header('Location: ../index.php?errmsg=error');
            }
            break;
    }
}else
{

    header('Location: ../index.php?errmsg=error');
    die();

}
?>