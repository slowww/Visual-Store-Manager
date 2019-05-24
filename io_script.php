<?php
session_start();
$rifconn = include_once('connection.php');
header('Content-Type: application/json');

/*$access=unserialize($_SESSION['access']);
$cdc=$access->getUsername();*/

switch($_SERVER['REQUEST_METHOD'])
{
    case "GET":
    getIo($_GET,$rifconn);
    break;
    case "POST":
    insertIo($_POST);
    break;

}

function insertIo($p)
{
    $conn= new mysqli("localhost","root","","vsm_db");
    $nrsett= date('W');
    $tiro=0;
    $eff=0;
    $rid=0;
    $fe=0;
    $pr=0;
    $tot=0;
    $mal=0;
    $mat=0;
    $varie=0;
    $org=0;
    $ent=0;
    $usc=0;
    $str=0;
    $inc=0;
    $resa=0;

    foreach ($p as $k => $v) {
        switch ($k) {

            case "tiro":
                if (is_nan($v)) {
                    $tiro = 0;
                } else {
                    $tiro = $v;
                }
                break;
            case "eff":
                $eff = $v;
                break;
            case "rid":
                if (is_nan($v)) {
                    $rid = 0;
                } else {
                    $rid = $v;
                }
                break;
            case "fe":
                if (is_nan($v)) {
                    $fe = 0;
                } else {
                    $fe = $v;
                }
                break;
            case "pr":
                if (is_nan($v)) {
                    $pr = 0;
                } else {
                    $pr = $v;
                }
                break;
            case "tot":
                $tot = $v;
                break;
            case "mal":
                if (is_nan($v)) {
                    $mal = $v;
                } else {
                    $mal = 0;
                }
                break;
            case "mat":
                if (is_nan($v)) {
                    $mat = 0;
                } else {
                    $mat = $v;
                }
                break;
            case "varie":
                if (is_nan($v)) {
                    $varie = 0;
                } else {
                    $varie = $v;
                }
                break;
            case "org":
                $org = $v;
                break;
            case "ent":
                if (is_nan($v)) {
                    $ent = 0;
                } else {
                    $ent = $v;
                }
                break;
            case "usc":
                if (is_nan($v)) {
                    $usc = 0;
                } else {
                    $usc = $v;
                }
                break;
            case "str":
                if (is_nan($v)) {
                    $str = 0;
                } else {
                    $str = $v;
                }
                break;
            case "inc":
                $inc = $v;
                break;
            case "resa":
                $resa = $v;
                break;
            case "id_dip":
                $id_dip = $v;
                break;
            case "pwd_dip":
                $pwd_dip = $v;
                break;
        }
    }





    //$pwd_dip = md5($pwd_dip);

    $stmt = $conn->prepare("SELECT cdc_fk FROM dipendenti WHERE id_dip like ? AND pwd_dip like ?;");

    $stmt->bind_param("ss", $id_dip, $pwd_dip);
    $stmt->execute();
    $result = $stmt->get_result();



    if ($result->num_rows==1) {
        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $neg = $row['cdc_fk'];

        }
        //se autenticazione ok
        $stmt = $conn->prepare("INSERT INTO `mod_io` (`nr_sett`, `cdc_fk`, `tiro`, `eff`, `rid`, `ferie`, `pr`, `tot`, `mal`, `mat`, `varie`, `org`, `entr`, `usc`, `str`, `incasso`, `resa`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $stmt->bind_param("isddddddddddddddd",$nrsett,$neg,$tiro,$eff,$rid,$fe,$pr,$tot,$mal,$mat,$varie,$org,$ent,$usc,$str,$inc,$resa);
        $stmt->execute();
        if ($stmt->affected_rows==1)
        {
            //var_dump($stmt->affected_rows);
            $msg=(object) array('response_code'=>'200');
            echo json_encode($msg);
        }else
        {
            //var_dump($stmt->affected_rows);
            $msg=(object) array('response_code'=>'401');
            echo json_encode($msg);
        }

    }else
    {   //se autenticazione va male
        $msg=(object) array('response_code'=>'400');
        echo json_encode($msg);
    }

    $stmt->close();
    $conn->close();
}

