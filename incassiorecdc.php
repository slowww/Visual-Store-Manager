<?php
session_start();
require 'connection.php';
require("user.php");
?>

<html>
<head>

    <link href="style.css" type="text/css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>

<body>
  <?php include 'backtomenu.html'; ?>
  <?php include 'header.php'; ?>
  <form action="op.php" method="post">
  <table>
    <tr>
      <td>Settimana numero</td>
      <td>Ore Tirocinio</td>
      <td>Ore eff. lavorate</td>
      <td>Riduz. oraria</td>
      <td>Ferie</td>
      <td>Permessi retr.</td>
      <td>TOT</td><!--riduz oraria + ferie + pr-->
    </tr>
    <tr id="primo">
      <td> <input type="number" maxlength="2" size="2" name="nrsett" required></td>
      <td><input type="number" maxlength="3" size="3" name="tiro"></td>
      <td><input type="number" maxlength="3" size="3" name="eff" required></td>
      <td><input type="number" maxlength="1" size="1" name="rid"></td>
      <td><input type="number" maxlength="3" size="3" name="fe"></td>
      <td><input type="number" maxlength="3" size="3" name="pr"></td>
      <td><input maxlength="3" size="3" id="tot" readonly required>
          <button type="button" onclick="total()">CALCOLA</button>
      </td>
    </tr>
    <tr>
      <td>Malattia</td>
      <td>Maternità</td>
      <td>Varie</td>
      <td>ORGANICO</td>
      <td>In entrata</td>
      <td>In uscita</td>
      <td>STRAORDINARIO</td><!--verificare calcolo-->
    </tr>
    <tr>
      <td><input type="number" maxlength="3" size="3" name="mal"></td>
      <td><input type="number" maxlength="3" size="3" name="mat"></td>
      <td><input type="number" maxlength="3" size="3" name="varie"></td>
      <td><input type="number" maxlength="3" size="3" name="org" required></td>
      <td><input type="number" maxlength="3" size="3" name="in"></td>
      <td><input type="number" maxlength="3" size="3" name="out" ></td>
      <td><input maxlength="3" size="3"  name="str" readonly>
            <button type="button" onclick="str()">CALCOLA</button>
        </td>
    </tr>
      <tr>
      <td>Incasso</td>
      <td>Resa oraria</td><!--verificare se si puo calcolare attraverso i dati inseriti-->
    </tr>
    <tr>
      <td><input type="number" maxlength="6" size="6" name="inc" required></td>
      <td><input type="number" maxlength="3" size="3" name="resa" required></td>
    </tr>
  </table>

  <table id="trasferte">
      <tr>
          <td><button type="button" onclick="addTd()">+</button></td>
      </tr>
  </table><br>

      <input type="text" name="id_dip" placeholder="ID dipendente" required><input type="password" name="pwd_dip" placeholder="password" required>
      <input type="submit" value="INVIA" id="submit_io">

</form>












<script>
    function total() {
    var total=0;
    var value=0;
        $("#primo [type='number']").each(
            function () {
                value= parseFloat($(this).val())
                console.log("cons:"+value);
                total+=value;
                //funziona ma sistemare calcolo!!!!!!
            }
        )

        $("#tot").val(total);
    }
</script>
<script>
    function str() {
        if(!$("#tot").val())
        {
            alert('Per effettuare il calcolo degli straordinari è necessario prima calcolare le ore totali.');
        }else
        {
            var tot = $("#tot").val();
            var org = $("org").val();
            var ent = $("in").val();
            var usc = $("out").val();

            var str = tot - org;
            int a = (true) ? 
        }

    }
</script>
<script>

        $("input[name=out]").keyup(function(){
        if($(this).val()) {
            $("#trasferte").css('visibility','visible');
            console.log("c'è valore")
        } else {
            $("#trasferte").css('visibility','hidden');
            console.log("no value")
        }

    });
</script>
<script>
    function addTd() {
        count=0;
        for(var i=0;i<$("#trasferte input[placeholder=cognome]").length;i++)
        {
            count++;
        }
        if(count<5)
        {
            $("#trasferte").append("<tr id=row"+count+">");
            $("#trasferte tr[id=row"+count+"]").append('<td><input type="text" maxlength="6" size="6" name="cogn'+count+'" placeholder="cognome"></td>');
            $("#trasferte tr[id=row"+count+"]").append('<td><input type="text" maxlength="6" size="6" name="neg'+count+'" placeholder="negozio"></td>');
            $("#trasferte tr[id=row"+count+"]").append('<td><input type="text" maxlength="6" size="6" name="ore'+count+'" placeholder="ore"></td><td><button type="button" onclick="remTd(this)">-</button></td>');
            $("#trasferte").append("</tr>");
        }else
        {
            alert('Valore massimo raggiunto.');
        }
    }

    function remTd(){//fix needed
        $(this).parent("tr").remove();
    }
</script>
</body>

</html>
<script>
    $("#submit_io").click(function(){

        var isbn = $("#isbn").val();
        var titolo = $("#titolo").val();
        var autore = $("#autore").val();
        var casaed = $("#casaed").val();
        $.ajax({
            type: "POST",
            url: "http://localhost/visual_store_manager/io_script.php",
            data: "isbn=" + isbn + "&titolo=" + titolo + "&autore=" + autore + "&casaed=" + casaed,
            dataType: "html",
            success: function()
            {

                $("#booklist").append("<tr><td>"+isbn+"</td><td>"+titolo+"</td><td>"+autore+"</td><td>"+casaed+"</td></tr>");


            },
            error: function()
            {
                alert("Errore nell'inserimento.");
            }
        });
    });
</script>
<?php
/*
if(isset($_POST["submit_io"]))
{
    $user_dip=$_POST['user_dip'];
    $pwd_dip=$_POST['pwd_dip'];

    $dip= new User($user_dip,$pwd_dip);

    if($dip->aut($user_dip,$pwd_dip))
    {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        //attenzione
        $stmt = $conn->prepare("INSERT INTO `mod_io`() VALUES ()");
        $stmt->bind_param();
        $stmt->execute();
        if (!$stmt->affected_rows)
        {
            print "Errore nell'inserimento :-(";
        }else
        {
            print "Inserimento avvenuto correttamente :-)";
        }
        $stmt->close();
        $conn->close();
    }else
    {
        die("ERRORE. Non è stato possibile salvare il modello.");
    }
}*/
?>