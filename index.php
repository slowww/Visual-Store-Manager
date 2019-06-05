<?php
session_start();
    if(isset($_GET['errmsg'])&&$_GET['errmsg']=="error")
    {
        echo "<script>alert('Dati inseriti non corretti. Riprovare!');</script>";

    }

    if(isset($_GET['logout'])&&$_GET['logout']==1)
    {
        //unset($_SESSION['access']);//Notice: Undefined variable: _SESSION  ?!?!
    }


?>
<html>
<head>

        <link href="style.css" type="text/css" rel="stylesheet">

    <title>VISUAL STORE MANAGER</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>

<body>

<h2 align="center">VISUAL <br> STORE <br> MANAGER</h2>

<form method="POST" action="autenticazione.php">
<div id="container">
    <div id="user">
        <label>USER  </label><br>
        <input type="text" name="user" required>
    </div>
    <div id="pass">
        <label>PASSWORD  </label><br>
        <input type="password" name="pwd" required>
    </div>
    <div id="radio">
        <label>Negozio</label>
        <input type="radio" name="accesstype" value="negozio" required>
        <label>Esterno</label>
        <input type="radio" name="accesstype" value="esterno" required>
    </div>
    <div id="select">
        <select name="op">
            <option selected value="incassiore">INCASSI E ORE (settimanali)</option>
            <option value="differenze">MOD. 140</option>
            <!--<option value="rifiuti">MOD. 54</option>-->
            <option value="manutenzioni">MOD. 23</option>
        </select>
    </div>
    <div id="sub">
        <input type="submit" value="ENTRA">
    </div>
</div>
</form>
</body>
</html>

<script>
    $(function () {
            $("input[value=esterno]").click(
                function () {
                    $("#select").hide('fast');
                }
            )

        }
    );

    $(function () {
            $("input[value=negozio]").click(
                function () {
                    $("#select").show('fast');
                }
            )

        }
    );
</script>


<script>
/*
* AJAX per login:
*
* recupera user e pwd e op.val()
* li manda all'api dip per login dipendente, cdc per login negozio
*
* api ritorna json con code response
*
* lato ajax: controlla code response, e se ok in base a op.val() fa il redirect
*
*
* */
</script>
