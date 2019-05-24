function ajxSend(){

    var tot = $("#tot").val();
    var str = $("#xtr").val();
    var id_dip = $("[name='id_dip']").val();
    var pwd_dip = $("[name='pwd_dip']").val();
    var nrsett = $("[name='nrsett']").val();
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
    var resa = $("[name='resa']").val();

    /*$("#form input[type=number]").each(function() {
        switch($(this).attr(name))
        {
            case 'nrsett':
                nrsett = $(this).val();
                break;
            case 'tiro':
                if(isNaN(this.value)) {
                    tiro = this.val(0);
                }else{
                    tiro = $(this).val();}
                break;
            case 'eff':
                eff = $(this).val();
                break;
            case 'rid':
                if(isNaN(this.value)) {
                    rid = this.val(0);
                }else{
                    rid = $(this).val();}
                break;
            case 'fe':
                if(isNaN(this.value)) {
                    fe = this.val(0);
                }else{
                    fe = $(this).val();}
                break;
            case 'pr':
                if(isNaN(this.value)) {
                    pr = this.val(0);
                }else{
                    pr = $(this).val();}
                break;
            case 'mal':
                if(isNaN(this.value)) {
                    mal = this.val(0);
                }else{
                    mal = $(this).val();}
                break;
            case 'mat':
                if(isNaN(this.value)) {
                    mat = this.val(0);
                }else{
                    mat = $(this).val();}
                break;
            case 'varie':
                if(isNaN(this.value)) {
                    varie = this.val(0);
                }else{
                    varie = $(this).val();}
                break;
            case 'org':
                org = $(this).val();
                break;
            case 'ent':
                if(isNaN(this.value)) {
                    ent = this.val(0);
                }else{
                    ent = $(this).val();}
                break;
            case 'usc':
                if(isNaN(this.value)) {
                    usc = this.val(0);
                }else{
                    usc = $(this).val();}
                break;
            case 'inc':
                inc = $(this).val();
                break;
            case 'resa':
                resa = $(this).val();
                console.log($(this).val());
                break;
        }//switch
    });//each*/

    $.ajax({
        type: "POST",
        url: "http://localhost/visual_store_manager/io_script.php",
        data: "nrsett="+nrsett+"&tiro="+tiro+"&eff="+eff+"&rid="+rid+"&fe="+fe+"&pr="+pr+"&mal="+mal+"&mat="+mat+"&varie="+varie+"&org="+org+"&ent"+ent+"&usc="+usc+"&inc="+inc+"&resa="+resa+"&tot="+tot+"&str="+str+"&id_dip="+id_dip+"&pwd_dip="+pwd_dip,
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
                    alert("Credenziali inserite errate: utente " + id_dip + " non presente nel database.");
                    break;
                default:
                    alert('boooooo');
                    break;
            }

        },

    });
}//ajxSend
