function ricercamod()
{
    //$("#chartcheckbox").css('visibility','hidden');
    $("#pop").empty();
    $("#result").empty();

    var cdc = $("#cdc").val();
    var mese = $("#mese").val();
    var anno = $("#anno").val();
    switch ($("#mod").val()) {

        case "io":
            const xlab=[];
            const ylab=[];
            $.ajax({
                type: 'GET',
                crossDomain: true,
                url: '../api/io_script.php?cdc='+cdc+'&mese='+mese+'&anno='+anno,

                success: function (data) {
                    if(data.msg)
                    {
                        alert(data.msg);
                    }else {
                        console.log(data);
                        $("#result").append('<table id="result_table"><thead><tr><th>ID MODELLO</th><th>DATA</th></tr></thead>');
                        $.each(data, function (i, dato) {
                            $("#result_table").append('<tr><td class="id_mod">' + dato.id_mod_io + '</td><td class="data_mod">' + dato.data_io + '</td></tr>');

                            xlab.push(dato.nr_sett);
                            ylab.push(dato.incasso);

                        });
                        $("#result").append('</table>');
                        createGraph(xlab,ylab);
                        //$("#chartcheckbox").css('visibility','visible');
                    }


                }
            });
            break;

        case "man":
            $("#chartcontainer").empty();
            $.ajax({
                type: 'GET',
                crossDomain: true,
                url: '../api/man_script.php?cdc='+cdc+'&mese='+mese+'&anno='+anno,

                success: function (data) {
                    if(data.msg)
                    {
                        alert(data.msg);
                    }else {

                        $("#result").append('<table id="result_table"><thead><tr><th>ID MODELLO</th><th>DATA</th></tr></thead>');
                        $.each(data, function (i, dato) {
                            $("#result_table").append('<tr><td class="id_mod">' + dato.id_mod_man + '</td><td class="data_mod">' + dato.data_man + '</td></tr>');



                        });
                        $("#result").append('</table>');

                        //$("#chartcheckbox").css('visibility','visible');
                    }


                }
            });
            break;

        case "diff":
            break;


    }


}