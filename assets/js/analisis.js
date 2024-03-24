//
console.log(jumlahTransaksiPerBulan);

// Initialize an object to store monthly transaction totals
var jumlahTransaksiPerBulan = {};

// Loop through each data entry
data.forEach(function(entry) {
    // Extract month and year from the date string
    var tgl_transaksi = new Date(entry.tgl_transaksi);
    var monthYear = tgl_transaksi.toLocaleString('en-US', { month: 'long' }) + ': ' + tgl_transaksi.getFullYear();

    // If the month-year key doesn't exist in jumlahTransaksiPerBulan, initialize it
    if (!jumlahTransaksiPerBulan[monthYear]) {
        jumlahTransaksiPerBulan[monthYear] = { pengeluaran: 0, pemasukan: 0 };
    }

    // Add the transaction amount to the appropriate category (pengeluaran or pemasukan)
    if (entry.jumlah_transaksi > 0) {
        jumlahTransaksiPerBulan[monthYear].pemasukan += entry.jumlah_transaksi;
    } else {
        jumlahTransaksiPerBulan[monthYear].pengeluaran += Math.abs(entry.jumlah_transaksi);
    }
});

// Menghitung rata-rata pengeluaran dan pemasukan
const bulan = Object.keys(jumlahTransaksiPerBulan);
const pengeluaran = bulan.map(bulan => jumlahTransaksiPerBulan[bulan].pengeluaran);
const pemasukan = bulan.map(bulan => jumlahTransaksiPerBulan[bulan].pemasukan);
const rataRataPengeluaran = pengeluaran.reduce((total, val) => total + val, 0) / bulan.length;
const rataRataPemasukan = pemasukan.reduce((total, val) => total + val, 0) / bulan.length;

// Menampilkan rata-rata pengeluaran dan pemasukan dalam console
console.log("Rata-rata Pengeluaran: " + rataRataPengeluaran);
console.log("Rata-rata Pemasukan: " + rataRataPemasukan);

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