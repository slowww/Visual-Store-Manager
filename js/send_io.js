function ajxSend(){

    /*var tot = $("#tot").val();
    var str = $("#xtr").val();
    var id_dip = $("[name='id_dip']").val();
    var pwd_dip = $("[name='pwd_dip']").val();
    var tiro = $("[name='tiro']").val();
    var eff = $("[name='eff']").val();
    var rid = $("[name='rid']").val();
    var fe = $("[name='fe']").val();
    var pr = $("[name='pr']").val();
    var mal = $("[name='mal']").val();
    var mat = $("[name='mat']").val();
    var varie = $("[name='varie']").val();
    var org = $("[name='org']").val();
    var ent = $("[name='ent']").val();
    var usc = $("[name='usc']").val();
    var inc = $("[name='inc']").val();
    var resa = $("[name='resa']").val();*/

    var io = $("form").serialize();


    $.ajax({
        type: "POST",
        crossDomain: true,
        url: "../api/io_script.php",
        data: io,
        dataType: "json",
        success: function(data)
        {
            console.log(data);
            switch(data.response_code)
            {
                case '200':
                    alert('Modello inserito correttamente!');
                    break;
                case '401':
                    alert("Errore nell'inserimento del modello!");
                    break;
                case '400':
                    alert("Credenziali inserite errate: utente non presente nel database.");
                    break;
                default:
                    alert(data.response_code);
                    break;
            }

        },

    });
}//ajxSend
