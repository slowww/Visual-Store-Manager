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
    $nrsett=0;
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
            case "nrsett":
                $nrsett = $v;
                break;
            case "tiro":
                if (isset($v)) {
                    $tiro = $v;
                } else {
                    $tiro = 0;
                }
                break;
            case "eff":
                $eff = $v;
                break;
            case "rid":
                if (isset($v)) {
                    $rid = $v;
                } else {
                    $rid = 0;
                }
                break;
            case "fe":
                if (isset($v)) {
                    $fe = $v;
                } else {
                    $fe = 0;
                }
                break;
            case "pr":
                if (isset($v)) {
                    $pr = $v;
                } else {
                    $pr = 0;
                }
                break;
            case "tot":
                $tot = $v;
                break;
            case "mal":
                if (isset($v)) {
                    $mal = $v;
                } else {
                    $mal = 0;
                }
                break;
            case "mat":
                if (isset($v)) {
                    $mat = $v;
                } else {
                    $mat = 0;
                }
                break;
            case "varie":
                if (isset($v)) {
                    $varie = $v;
                } else {
                    $varie = 0;
                }
                break;
            case "org":
                $org = $v;
                break;
            case "ent":
                if (isset($v)) {
                    $ent = $v;
                } else {
                    $ent = 0;
                }
                break;
            case "usc":
                if (isset($v)) {
                    $usc = $v;
                } else {
                    $usc = 0;
                }
                break;
            case "str":
                if (isset($v)) {
                    $str = $v;
                } else {
                    $str = 0;
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

