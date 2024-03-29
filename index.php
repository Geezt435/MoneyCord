<?php
require_once "assets/php/getConnection.php";

$conn = getConnection();

//Script php untuk delete transaksi
if (isset($_GET['deleteButton'])) {
  $idTransaksi = $_GET['idTransaksi'];

  $sqlDelete = "DELETE FROM tb_records WHERE id_transaksi = ?";
  $requestDelete = mysqli_prepare($conn, $sqlDelete);

  mysqli_stmt_bind_param($requestDelete, "s", $idTransaksi);
  mysqli_stmt_execute($requestDelete);
  mysqli_stmt_close($requestDelete);
  mysqli_close($conn);

  header("Location: index.php");
  exit;
}

//Script php untuk update transaksi
if (isset($_GET['editButton'])) {
  $idTransaksi = $_GET['idTransaksi'];
  $jumlahTransaksi = $_GET['jumlahTransaksi'];
  $tglTransaksi = $_GET['tglTransaksi'];
  $deskripsiTransaksi = $_GET['deskripsiTransaksi'];
  $jenisTransaksi = $_GET['jenisTransaksi'];

  $sqlDelete = "UPDATE tb_records SET jumlah_transaksi = ?, tgl_transaksi = ?, deskripsi_transaksi = ?, jenis_transaksi = ? WHERE id_transaksi = ?";
  $requestDelete = mysqli_prepare($conn, $sqlDelete);

  mysqli_stmt_bind_param($requestDelete, "s", $jumlahTransaksi, $tglTransaksi, $deskripsiTransaksi, $jenisTransaksi, $idTransaksi);
  mysqli_stmt_execute($requestDelete);
  mysqli_stmt_close($requestDelete);
  mysqli_close($conn);

  header("Location: index.php");
  exit;
}

$sql = "SELECT id_transaksi, jumlah_transaksi, tgl_transaksi, deskripsi_transaksi, jenis_transaksi FROM tb_records";
$request = mysqli_query($conn, $sql);
//End script mengambil data blog

// Output the data as JSON directly into a JavaScript variable
$all = mysqli_fetch_all($request);
$json_data = json_encode($all);
?>

<script>
    var data = JSON.parse('<?php echo $json_data; ?>');
    // Now you can work with the 'data' variable as a JavaScript array
    console.log(data);

    function getTransaksiId(idForm, idTransaksi) {
      console.log(idTransaksi);
      const formTarget = document.getElementById(idForm);
      const createInput = document.createElement("input");

      createInput.setAttribute("type", "hidden");
      createInput.setAttribute("name", "idTransaksi");
      createInput.setAttribute("value", idTransaksi);

      formTarget.appendChild(createInput);
    }
</script>

<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
  <head>
    <title>MoneyCord</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Kelompok 5">
    <link rel="icon" href="assets/brand/brand.png" type="image/x-icon">
    <link rel="stylesheet" href="assets/dist/css/bootstrap.min.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- <link href="assets/css/portal.css" id="theme-style" rel="stylesheet"> -->
    <script src="assets/js/color-modes.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- Asset Scripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
<script src="assets/dist/js/bootstrap.bundle.min.js"></script> 

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .b-example-divider {
        width: 100%;
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
      }

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }

      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }

      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }

      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
      }

      .btn-bd-primary {
        --bd-violet-bg: #712cf9;
        --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

        --bs-btn-font-weight: 600;
        --bs-btn-color: var(--bs-white);
        --bs-btn-bg: var(--bd-violet-bg);
        --bs-btn-border-color: var(--bd-violet-bg);
        --bs-btn-hover-color: var(--bs-white);
        --bs-btn-hover-bg: #6528e0;
        --bs-btn-hover-border-color: #6528e0;
        --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
        --bs-btn-active-color: var(--bs-btn-hover-color);
        --bs-btn-active-bg: #5a23c8;
        --bs-btn-active-border-color: #5a23c8;
      }

      .bd-mode-toggle {
        z-index: 1500;
      }

      .bd-mode-toggle .dropdown-menu .active .bi {
        display: block !important;
      }
    </style>
  </head>
  <body>
    <!-- Theme -->
    <svg xmlns="http://www.w3.org/2000/svg" class="d-none">
      <symbol id="check2" viewBox="0 0 16 16">
        <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"></path>
      </symbol>
      <symbol id="circle-half" viewBox="0 0 16 16">
        <path d="M8 15A7 7 0 1 0 8 1v14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z"></path>
      </symbol>
      <symbol id="moon-stars-fill" viewBox="0 0 16 16">
        <path d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278z"></path>
        <path d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.734 1.734 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.734 1.734 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.734 1.734 0 0 0 1.097-1.097l.387-1.162zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L13.863.1z"></path>
      </symbol>
      <symbol id="sun-fill" viewBox="0 0 16 16">
        <path d="M8 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z"></path>
      </symbol>
    </svg>
    <div class="dropdown position-fixed bottom-0 end-0 mb-3 me-3 bd-mode-toggle">
      <button class="btn btn-bd-primary py-2 dropdown-toggle d-flex align-items-center" id="bd-theme" type="button" aria-expanded="false" data-bs-toggle="dropdown" aria-label="Toggle theme (light)">
        <svg class="bi my-1 theme-icon-active" width="1em" height="1em">
          <use href="#sun-fill"></use>
        </svg>
        <span class="visually-hidden" id="bd-theme-text">Toggle theme</span>
      </button>
      <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="bd-theme-text">
        <li>
          <button type="button" class="dropdown-item d-flex align-items-center active" data-bs-theme-value="light" aria-pressed="true">
            <svg class="bi me-2 opacity-50" width="1em" height="1em">
              <use href="#sun-fill"></use>
            </svg>
            Light
            <svg class="bi ms-auto d-none" width="1em" height="1em">
              <use href="#check2"></use>
            </svg>
          </button>
        </li>
        <li>
          <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="dark" aria-pressed="false">
            <svg class="bi me-2 opacity-50" width="1em" height="1em">
              <use href="#moon-stars-fill"></use>
            </svg>
            Dark
            <svg class="bi ms-auto d-none" width="1em" height="1em">
              <use href="#check2"></use>
            </svg>
          </button>
        </li>
        <li>
          <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="auto" aria-pressed="false">
            <svg class="bi me-2 opacity-50" width="1em" height="1em">
              <use href="#circle-half"></use>
            </svg>
            Auto
            <svg class="bi ms-auto d-none" width="1em" height="1em">
              <use href="#check2"></use>
            </svg>
          </button>
        </li>
      </ul>
    </div>

    <!-- Navigator -->
    <header data-bs-theme="dark">
      <div class="navbar navbar-dark bg-dark shadow-sm">
        <div class="container">
          <a href="#" class="navbar-brand d-flex align-items-center">
            <img width="10%" src="assets/brand/brand.png">
            <strong>Money</strong>Cord
          </a>
        </div>
      </div>
    </header>

    <!-- Body -->
    <main>
      <section class="text-center container">
        <div class="row py-5">
          <div class="col-lg-6 col-md-8 mx-auto">
            <div class="container">
                <h2 class="mt-5 mb-3">Chart Pengeluaran dan Pemasukan</h2>
                <canvas id="myChart" width="600" height="400"></canvas>
            </div>
          </div>
        </div>
      <section class="text-center container">

        <!-- Tabel Rata - rata  -->
        <div class="row py-5">
          <div class="col-lg-6 col-md-3 mx-auto">
            <div class="container">
              <div class="container mt-5">
                <h2>Table Rata - Rata</h2>
                <table class="table table-striped text-center">
                  <thead>
                    <tr>
                      <th>Bulan</th>
                      <th>Pengeluaran</th>
                      <th>Pemasukan</th>
                    </tr>
                  </thead>
                  <tbody>
                  <tr>
                      <th scope="row">January</th>
                      <td><div id="rataPengeluaran1"></div></td>
                      <td><div id="rataPemasukan1"></div></td>
                    </tr>
                    <tr>
                      <th scope="row">February</th>
                      <td><div id="rataPengeluaran2"></div></td>
                      <td><div id="rataPemasukan2"></div></td>
                    </tr>
                    <tr>
                      <th scope="row">March</th>
                      <td><div id="rataPengeluaran3"></div></td>
                      <td><div id="rataPemasukan3"></div></td>
                    </tr>
                    <tr>
                      <th scope="row">April</th>
                      <td><div id="rataPengeluaran4"></div></td>
                      <td><div id="rataPemasukan4"></div></td>
                    </tr>
                    <tr>
                      <th scope="row">May</th>
                      <td><div id="rataPengeluaran5"></div></td>
                      <td><div id="rataPemasukan5"></div></td>
                    </tr>
                    <tr>
                      <th scope="row">June</th>
                      <td><div id="rataPengeluaran6"></div></td>
                      <td><div id="rataPemasukan6"></div></td>
                    </tr>
                    <tr>
                      <th scope="row">July</th>
                      <td><div id="rataPengeluaran7"></div></td>
                      <td><div id="rataPemasukan7"></div></td>
                    </tr>
                    <tr>
                      <th scope="row">August</th>
                      <td><div id="rataPengeluaran8"></div></td>
                      <td><div id="rataPemasukan8"></div></td>
                    </tr>
                    <tr>
                      <th scope="row">September</th>
                      <td><div id="rataPengeluaran9"></div></td>
                      <td><div id="rataPemasukan9"></div></td>
                    </tr>
                    <tr>
                      <th scope="row">October</th>
                      <td><div id="rataPengeluaran10"></div></td>
                      <td><div id="rataPemasukan10"></div></td>
                    </tr>
                    <tr>
                      <th scope="row">November</th>
                      <td><div id="rataPengeluaran11"></div></td>
                      <td><div id="rataPemasukan11"></div></td>
                    </tr>
                    <tr>
                      <th scope="row">December</th>
                      <td><div id="rataPengeluaran12"></div></td>
                      <td><div id="rataPemasukan12"></div></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

        <!-- Masukkan Data -->
        <div class="row py-lg-5">
          <div class="col-lg-6 col-md-8 mx-auto">
            <h3 class="p-2">Masukkan data transaksi dibawah ini!</h3>
            <form id="crud-form" method="post" action="assets/php/add.php">
              <div class="form-group">
                <label id="jumlah_transaksi">Jumlah Transaksi</label>
                <input type="text" class="form-control" name="jumlah_transaksi" placeholder="Enter Jumlah Transaksi">
              </div>
              <div class="form-group">
                <label id="tgl_transaksi">Tanggal Transaksi</label>
                <input type="date" class="form-control" name="tgl_transaksi">
              </div>
              <div class="form-group">
                <label id="deskripsi_transaksi">Deskripsi Transaksi</label>
                <textarea class="form-control" name="deskripsi_transaksi" rows="3" placeholder="Enter Deskripsi Transaksi"></textarea>
              </div>
              <div class="form-group">
                <label id="jenis_transaksi">Jenis Transaksi</label>
                <select class="form-control" name="jenis_transaksi">
                  <option value="debit">Debit</option>
                  <option value="kredit">Cash</option>
                </select>
              </div>
              <button class="btn btn-primary my-2" type="submit">Add</button>
            </form>
            
            <!-- JS Read for Testing
            <div id="records"></div> -->
            
            <!-- Fetch -->
            <div class="tab-content" id="orders-table-tab-content">
              <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
                <div class="app-card app-card-orders-table shadow-sm mb-6">
                  <div class="app-card-body">
                    <div class="table-responsive">
                      <table class="table app-table-hover mb-4 text-center">
                        <thead>
                          <tr>
                            <th class="cell">Jumlah Transaksi</th>
                            <th class="cell">Tanggal Transaksi</th>
                            <th class="cell">Deskripsi Transaksi</th>
                            <th class="cell">Jenis Transaksi</th>
                            <th class="cell"></th>
                            <th class="cell"></th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          // Print data detail blog dari request yang telah dibuat sebelumnya
                          if (mysqli_num_rows($request) > 0) {
                            foreach ($result = $all as $index) {
                              $idTransaksi = $index[0];
                              $jumlahTransaksi = $index[1];
                              $tglTransaksi = $index[2];
                              $deskripsiTransaksi = $index[3];
                              $jenisTransaksi = $index[4];
                              echo <<<TULIS
                                <tr>
                                  <td class="cell"><span class="truncate">$jumlahTransaksi</span></td>
                                  <td class="cell"><span>$tglTransaksi</span></td>
                                  <td class="cell"><span>$deskripsiTransaksi</span></td>
                                  <td class="cell"><span>$jenisTransaksi</span></td>
                                  <td class="cell"> 
                                    <a class="btn btn-primary my-2" data-bs-toggle="modal" href="#edit-transaksi" onclick="getTransaksiId('conEditTransaksi','$idTransaksi')">Edit</a>
                                  </td>
                                  <td class="cell">
                                    <a class="btn btn-danger my-2" data-bs-toggle="modal" href="#delete-transaksi" onclick="getTransaksiId('conDeleteTransaksi','$idTransaksi')">Delete</a>
                                  </td>      
                                </tr>
                              TULIS;
                            }
                          }
                          mysqli_close($conn);
                          ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>

  <div class="app-wrapper">
    <div class="app-content pt-3 p-md-3 p-lg-4">
      <div class="container-xl">

        <!-- Modal Delete -->
        <div class="modal fade" id="delete-transaksi" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Delete Transaksi</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <p>Apakah anda yakin ingin menghapus data transaksi ini?</p>
              </div>
              <div class="modal-footer">
                <form action="" method="GET" id="conDeleteTransaksi">
                    <button class="btn btn-danger" name="deleteButton" type="submit">Delete</button>
                </form>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>

        <!-- Modal Update -->
        <div class="modal fade" id="edit-transaksi" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Edit Transaksi</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
                <form id="conEditTransaksi" method="get" action="">
                  <div class="modal-body">
                    <div class="form-group">
                      <label id="jumlahTransaksi">Jumlah Transaksi</label>
                      <input type="text" class="form-control" name="jumlahTransaksi" placeholder="Enter Jumlah Transaksi Baru">
                    </div>
                    <div class="form-group">
                      <label id="tglTransaksi">Tanggal Transaksi</label>
                      <input type="date" class="form-control" name="tglTransaksi">
                    </div>
                    <div class="form-group">
                      <label id="deskripsiTransaksi">Deskripsi Transaksi</label>
                      <textarea class="form-control" name="deskripsiTransaksi" rows="3" placeholder="Enter Deskripsi Transaksi"></textarea>
                    </div>
                    <div class="form-group">
                      <label id="jenisTransaksi">Jenis Transaksi</label>
                      <select class="form-control" name="jenisTransaksi">
                        <option value="debit">Debit</option>
                        <option value="kredit">Cash</option>
                      </select>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button class="btn btn-success" name="editButton" type="submit">Update</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                  </div>
                </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Footer -->
  <footer class="text-body-secondary">
    <div class="navbar navbar-dark bg-dark">
      <div class="container">
        <p class="float-end">
          <a class="btn btn-secondary" href="#">Back to top</a>
        </p>
      </div>
    </div>
  </footer>
  <script src="assets/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>

<!-- Custom Scripts -->
<script src="assets/js/analisis.js"></script>