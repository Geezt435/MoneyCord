
function getTransaksiId(idForm, idTransaksi) {
    console.log(idTransaksi);
    const formTarget = document.getElementById(idForm);
    const createInput = document.createElement("input");

    createInput.setAttribute("type", "hidden");
    createInput.setAttribute("name", "idTransaksi");
    createInput.setAttribute("value", idTransaksi);

    formTarget.appendChild(createInput);
  }

const myModal = document.getElementById('myModal')
const myInput = document.getElementById('myInput')

myModal.addEventListener('shown.bs.modal', () => {
myInput.focus()
})

// jQuery(document).ready(function($){
//     // Function to fetch and display records
//     function fetchRecords() {
//         $.ajax({
//             url: 'assets/php/fetch.php',
//             type: 'GET',
//             success: function(response) {
//                 $('#records').html(response);
//             }
//         });
//     }

//     // Fetch records on page load
//     fetchRecords();
// });

// // $(document).ready(function(){
// //     // Function to fetch and display records
// //     function fetchRecords() {
// //         $.ajax({
// //             url: 'fetch.php',
// //             type: 'GET',
// //             success: function(response) {
// //                 $('#records').html(response);
// //             }
// //         });
// //     }

// //     // Fetch records on page load
// //     fetchRecords();

// //     // Add record
// //     $('#crud-form').on('submit', function(e){
// //         e.preventDefault();
// //         var jumlah_transaksi = $('#jumlah_transaksi').val();
// //         var tgl_transaksi = $('#tgl_transaksi').val();
// //         var deskripsi_transaksi = $('#deskripsi_transaksi').val();
// //         var jenis_transaksi = $('#jenis_transaksi').val();
// //         $.ajax({
// //             url: 'add.php',
// //             type: 'POST',
// //             data: {jumlah_transaksi: jumlah_transaksi, tgl_transaksi: tgl_transaksi, deskripsi_transaksi: deskripsi_transaksi, jenis_transaksi: jenis_transaksi},
// //             success: function(response) {
// //                 fetchRecords();
// //                 $('#jumlah_transaksi').val('');
// //                 $('#tgl_transaksi').val('');
// //                 $('#deskripsi_transaksi').val('');
// //                 $('#jenis_transaksi').val('');
// //             }
// //         });
// //     });

// //     // Update record
// //     $('#records').on('click', '.update', function(){
// //         var id = $(this).data('id');
// //         var newName = prompt('Enter new name:');
// //         if(newName) {
// //             $.ajax({
// //                 url: 'update.php',
// //                 type: 'POST',
// //                 data: {id: id, name: newName},
// //                 success: function(response) {
// //                     fetchRecords();
// //                 }
// //             });
// //         }
// //     });

// //     // Delete record
// //     $(document).on('click', '.delete', function(){
// //         var id = $(this).data('id');
// //         $.ajax({
// //             url: 'delete.php',
// //             type: 'POST',
// //             data: {id: id},
// //             success: function(response) {
// //                 fetchRecords();
// //             }
// //         });
// //     });
// // });
