<?php

    if(isset($_GET['errmsg'])&&$_GET['errmsg']=="error")
    {
        echo "<script>alert('Dati inseriti non corretti. Riprovare!');</script>";
    }

    if(isset($_GET['logout'])&&$_GET['logout']==1)
    {
        unset($_SESSION['access']);
    }


?>
<html>
<head>
    <title>VISUAL STORE MANAGER</title>
<style>

    body {
        background-color: #4169E1;
        font-family: sans-serif;
    }
    #container {
        padding: 2%;
        position: relative;
        left: 32.5vw;
        top: 15vh;
        alignment: center;
        background-color: lightgray;
        border-radius: 5%;
        width: 30vw;
        height: 40vh;
        text-align: center;
    }

    input[type="text"],input[type="password"]{
        border-radius: 2%;
    }


    #container div {
        right: 2vw;
        display: table;
        align-content: center;
        margin: 2% 2% 7% 2%;
        width: 100%;
        clear: both;
    }

</style>
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
    )

    $(function () {
            $("input[value=negozio]").click(
                function () {
                    $("#select").show('fast');
                }
            )

        }
    )
</script>

