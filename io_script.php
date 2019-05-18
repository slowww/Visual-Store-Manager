<?php
session_start();
$rifconn = include_once('connection.php');
header('Content-Type: application/json');

$access=unserialize($_SESSION['access']);
$cdc=$access->getUsername();

switch($_SERVER['REQUEST_METHOD'])
{
    case "GET":
    getIo($_GET,$rifconn);
    break;
    case "POST":
    insertIo($_POST,$rifconn,$cdc);
    break;

}

function insertIo($p,$conn,$neg)
{
    switch ($p) {
        case "nrsett":
            $nrsett = $p['nrsett'];
            break;
        case "tiro":
            if (isset($p['tiro'])) {
                $tiro = $p['tiro'];
            } else {
                $tiro = 0;
            }
            break;
        case "eff":
            $eff = $p['eff'];
            break;
        case "rid":
            if (isset($p['rid'])) {
                $rid = $p['rid'];
            } else {
                $rid = 0;
            }
            break;
        case "fe":
            if (isset($p['fe'])) {
                $fe = $p['fe'];
            } else {
                $fe = 0;
            }
            break;
        case "pr":
            if (isset($p['pr'])) {
                $pr = $p['pr'];
            } else {
                $pr = 0;
            }
            break;
        case "tot":
            $tot = $p['tot'];
            break;
        case "mal":
            if (isset($p['mal'])) {
                $mal = $p['mal'];
            } else {
                $mal = 0;
            }
            break;
        case "mat":
            if (isset($p['mat'])) {
                $mat = $p['mat'];
            } else {
                $mat = 0;
            }
            break;
        case "varie":
            if (isset($p['varie'])) {
                $varie = $p['varie'];
            } else {
                $varie = 0;
            }
            break;
        case "org":
            $org = $p['org'];
            break;
        case "in":
            if (isset($p['in'])) {
                $in = $p['in'];
            } else {
                $in = 0;
            }
            break;
        case "out":
            if (isset($p['out'])) {
                $out = $p['out'];
            } else {
                $out = 0;
            }
            break;
        case "str":
            if (isset($p['str'])) {
                $str = $p['str'];
            } else {
                $str = 0;
            }
            break;
        case "inc":
            $inc = $p['inc'];
            break;
        case "resa":
            $resa = $p['resa'];
            break;
        case "user_dip":
            $id_dip = $p['id_dip'];
            break;
        case "pwd_dip":
            $pwd_dip = $p['pwd_dip'];
    }

    $stmt = $conn->prepare("SELECT nome_dip,cogn_dip FROM dipendenti WHERE id_dip = ? AND pwd_dip = ?;");
    $stmt->bind_param("ss", $id_dip, $pwd_dip);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        //se autenticazione ok
        $stmt = $conn->prepare("INSERT INTO mod_io VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $stmt->bind_param("isiiiiiiiiiiiiii",$nrsett,$neg,$tiro,$eff,$rid,$fe,$pr,$tot,$mal,$mat,$varie,$org,$in,$out,$str,$inc.$resa);
        $stmt->execute();
        if (!$stmt->affected_rows)
        {
            $msg=(object) array('response code'=>'400');
            echo json_encode($msg);
        }else
        {
            $msg=(object) array('response code'=>'200');
            echo json_encode($msg);
        }

    }else
    {   //se autenticazione va male
        $msg=(object) array('Dati inseriti non corretti.');
        echo json_encode($msg);
    }

}

