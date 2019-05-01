<?php session_start();
require("user.php");?>

<html>

<head>
    <link href="style.css" rel="stylesheet" type="text/css">

</head>

<body>
<?php include 'backtomenu.html'; ?>
<?php include 'header.php'?>
<h2>SEGNALAZIONE DIFFERENZE DI CARICO</h2>
<form action="manutenz.php" method="post">
    <table border="1">
        <tr><td colspan="4">Merce ordinata e caricata su bolla accompagnamento merci</td><td colspan="4">Merce effettivamente ricevuta nel pdv</td></tr>
        <tr><td>Codice art.</td><td>Descrizione</td><td colspan="2">Qtà</td><td>Codice art.</td><td>Descrizione</td><td colspan="2">Qtà</td></tr>
        <tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
        <tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
        <tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
        <tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
        <tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
        <tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
        <tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
        <tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
        <tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
        <tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
    </table>
    <input type="submit">
</form>


</body>
</html>

<script>

    $('#altro').click(function() {
        if( $(this).is(':checked')) {
            $("#comment").show();
        } else {
            $("#comment").hide();
        }
    });
</script>