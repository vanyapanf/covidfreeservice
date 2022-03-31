var covidStatCanvas = document.getElementById('covidStatChart').getContext('2d');

var myChart = new Chart(covidStatCanvas, {
    type: 'line',
    data: {
        datasets: [
            {
                label: 'Заболевшие',
                data: [10,11,13,20,15,14,8],
                borderColor: '#f08080',
                backgroundColor: 'transparent',
                tension: 0.5
            },
            {
                label: 'Выздоровевшие',
                data: [11,12,13,14,18,20,17],
                borderColor: '#1e90ff',
                backgroundColor: 'transparent',
                tension: 0.5
            }
        ]
    },
    options: {
        scales: {
            x: {
                grid: {
                    display: false
                }
            },
            y: {
                grid: {
                    display: false
                }
            }
        },
        elements: {
            point:{
                radius: 0
            }
        }
    }
});

