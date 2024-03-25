// Initialize an object to store monthly transaction totals


var jumlahTransaksiPerBulan = {
    "January": [0, 0, 0],
    "February": [0, 0, 0],
    "March": [0, 0, 0],
    "April": [0, 0, 0],
    "May": [0, 0, 0],
    "June": [0, 0, 0],
    "July": [0, 0, 0],
    "August": [0, 0, 0],
    "September": [0, 0, 0],
    "October": [0, 0, 0],
    "November": [0, 0, 0],
    "December": [0, 0, 0]
};

// Loop through each data entry
data.forEach(function(entry) {
    var month = new Date(entry[2]).getMonth();

    var curTransaksi = jumlahTransaksiPerBulan[Object.keys(jumlahTransaksiPerBulan)[month]];

    if (entry[1] > 0) {
        curTransaksi[1] = parseInt(curTransaksi[1])  + parseInt(entry[1]);
    } else if (entry[1] < 0) {
        curTransaksi[0] = parseInt(curTransaksi[1]) + parseInt(entry[1]);
    }
    curTransaksi[2] = parseInt(curTransaksi[2]) + 1;
    console.log(curTransaksi);
    console.log(curTransaksi[0]);
    console.log(curTransaksi[1]);
    console.log(curTransaksi[2]);
});

var instance = 1;

Object.entries(jumlahTransaksiPerBulan).forEach(function([bulan, transaction]) {
    var pengeluaran = transaction[0];
    var pemasukan = transaction[1];

    var rataPengeluaran = parseFloat(pengeluaran) / parseFloat(transaction[2]);
    var rataPemasukan = parseFloat(pemasukan) / parseFloat(transaction[2]);

    // Output the values to the console
    console.log(rataPengeluaran);
    console.log(rataPemasukan);

    // Output the values to the page
    const rataPengeluaranDiv = document.getElementById('rataPengeluaran' + instance);
    const rataPemasukanDiv = document.getElementById('rataPemasukan' + instance);
    rataPengeluaranDiv.innerHTML = Math.round(rataPengeluaran);
    rataPemasukanDiv.innerHTML = Math.round(rataPemasukan);
    instance += 1;
});

console.log(data);
console.log("data");
console.log(jumlahTransaksiPerBulan);
console.log("jumlahTransaksiPerBulan");

// Menghitung rata-rata pengeluaran dan pemasukan
const bulan = Object.keys(jumlahTransaksiPerBulan);
const pengeluaran = bulan.map(bulan => jumlahTransaksiPerBulan[bulan][0]);
const pemasukan = bulan.map(bulan => jumlahTransaksiPerBulan[bulan][1]);

// Membuat chart
var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: bulan,
        datasets: [{
            label: 'Pengeluaran',
            data: pengeluaran,
            backgroundColor: 'rgba(255, 99, 132, 0.2)',
            borderColor: 'rgba(255, 99, 132, 1)',
            borderWidth: 1
        }, {
            label: 'Pemasukan',
            data: pemasukan,
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
