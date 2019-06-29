function createGraph(xlabels,ylabels) {

    var ctx = document.getElementById('myChart').getContext('2d');

    var myChart = new Chart(ctx, {
        type: 'line',
        responsive: true,
        maintainAspectRatio: false,
        data: {
            labels: xlabels,
            datasets: [{
                label: 'Variazione incasso su base settimanale',
                data: ylabels,
                backgroundColor: [
                    'rgba(176, 196, 222, 0.5)'
                ],
                borderColor: [
                    'rgba(255, 0, 0, 1)'
                ],
                borderWidth: 1
            }]
        }
    });

}