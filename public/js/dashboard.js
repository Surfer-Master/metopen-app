var data1 = {
    labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'],
    datasets: [
        {
            label: 'Temperatur',
            data: [10, 20, 30, 25, 35, 45],
            fill: false,
            borderColor: 'red',
            borderWidth: 3
        }
    ]
};

// Data untuk chart kedua
var data2 = {
    labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'],
    datasets: [
        {
            label: 'Kelembaban',
            data: [5, 30, 60, 25, 10, 78],
            fill: false,
            borderColor: 'blue',
            borderWidth: 3
        }
    ]
};

var data3 = {
    labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'],
    datasets: [
        {
            label: 'Kekeruhan',
            data: [10, 20, 30, 25, 35, 45],
            fill: false,
            borderColor: 'yellow',
            borderWidth: 3
        }
    ]
};

var data4 = {
    labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'],
    datasets: [
        {
            label: 'Ph Air',
            data: [10, 20, 30, 25, 35, 45],
            fill: false,
            borderColor: 'darkgreen',
            borderWidth: 3
        }
    ]
};

// Opsi untuk kedua chart
var options = {
    scales: {
        yAxes: [{
            ticks: {
                beginAtZero: true
            }
        }]
    }
};

// Membuat chart pertama
var ctx = document.getElementById('myChart').getContext('2d');
var chart1 = new Chart(ctx, {
    type: 'line',
    data: data1,
    options: options
});

// Membuat chart kedua
var ctx2 = document.getElementById('myChart2').getContext('2d');
var chart2 = new Chart(ctx2, {
    type: 'line',
    data: data2,
    options: options
});

var ctx3 = document.getElementById('myChart3').getContext('2d');
var chart3 = new Chart(ctx3, {
    type: 'line',
    data: data3,
    options: options
});

var ctx4 = document.getElementById('myChart4').getContext('2d');
var chart4 = new Chart(ctx4, {
    type: 'line',
    data: data4,
    options: options
});