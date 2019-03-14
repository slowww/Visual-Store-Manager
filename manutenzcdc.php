<html>

<head>
<link rel="stylesheet" type="text/css" href="style.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
$("document").ready(function(){
    $("comment").hide();
})
</script>

</head>

<body>
<?php include 'backtomenu.html'; ?>

<h2>INTERVENTO DI MANUTENZIONE</h2>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
    <table border="1">
        <tr><td>Data: <?php echo date("d/m/Y")?></tr>
        <tr><td>Ditta che esegue l'intervento: </td><td><input type="text" name="ditta"></td></tr>
        <tr><td>Manutenzione: </td>
            <td>
                <select name="tipoman">
                    <option selected></option>
                    <option value="ord">Ordinaria</option>
                    <option value="straord">Straordinaria</option>
                </select>
            </td>
        </tr>
        <tr><td>Riferimento richiesta autorizzazione </td><td><input type="text" name="resp"></td></tr>
        <tr><td>Operazioni eseguite </td><td><textarea name="operazioni"></textarea></td></tr>
        <tr><td>Attrezzature oggetto di intervento </td><td><textarea name="attrezz"></textarea></td></tr>
        <tr><td>Durata intervento in ore </td><td><input type="number" name="durata"> x 
            <input type="number" name="noperai" maxlength="2" placeholder="numero operai"></td>
        </tr>
        <tr><td>Materiali impiegati</td><td><input type="text" name="mat"></td></tr>
        <tr><td>Osservazioni gestore:</td><td>Intervento soddisfacente <input type="checkbox" name="oss1"><br>
                                            Altro <input id="altro" type="checkbox" unchecked><br>
                                            <textarea id="comment" rows='4' cols='50' name='comment' placeholder='Commento?'></textarea></td></tr>


      

    </table>
</form>


</body>



<script>

$('#altro').click(function() {
    if( $(this).is(':checked')) {
        $("#comment").show();
    } else {
        $("#comment").hide();
    }
}); 



 







</script>


</html>