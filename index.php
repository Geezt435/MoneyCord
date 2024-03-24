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

  header("");
}

//Script php untuk update transaksi
if (isset($_GET['editButton'])) {
  $idTransaksi = $_GET['idTransaksi'];
  $dateReleased = $_GET['date-release'];
  $jenisTransaksi = $_GET['date-expired'];

  $sqlDelete = "UPDATE tb_records SET date_published = ?, date_expired = ? WHERE id_transaksi = ?";
  $requestDelete = mysqli_prepare($conn, $sqlDelete);

  mysqli_stmt_bind_param($requestDelete, "sss", $dateReleased, $jenisTransaksi, $idTransaksi);
  mysqli_stmt_execute($requestDelete);
  mysqli_stmt_close($requestDelete);
  mysqli_close($conn);

  header("");
}

$sql = "SELECT id_transaksi, jumlah_transaksi, tgl_transaksi, deskripsi_transaksi, jenis_transaksi FROM tb_records";
$request = mysqli_query($conn, $sql);
//End script mengambil data blog
?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>MoneyCord</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Kelompok 5">
    <link rel="icon" href="assets/brand/mcdonald.jpg" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
    <link rel="stylesheet" href="assets/dist/css/bootstrap.min.css">
    <!-- <link href="assets/css/portal.css" id="theme-style" rel="stylesheet"> -->

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
      <div class="collapse text-bg-dark" id="navbarHeader">
        <div class="container">
          <div class="row">
            <div class="col-sm-8 col-md-7 py-4">
              <h4>About</h4>
              <p class="text-body-secondary">Add some information about the album below, the author, or any other background context. Make it a few sentences long so folks can pick up some informative tidbits. Then, link them off to some social networking sites or contact information.</p>
            </div>
            <div class="col-sm-4 offset-md-1 py-4">
              <h4>Contact</h4>
              <ul class="list-unstyled">
                <li><a href="#" class="text-white">Follow on Twitter</a></li>
                <li><a href="#" class="text-white">Like on Facebook</a></li>
                <li><a href="#" class="text-white">Email me</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="navbar navbar-dark bg-dark shadow-sm">
        <div class="container">
          <a href="#" class="navbar-brand d-flex align-items-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" aria-hidden="true" class="me-2" viewBox="0 0 24 24">
              <path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path>
              <circle cx="12" cy="13" r="4"></circle>
            </svg>
            <strong>MoneyCord</strong>
          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
        </div>
      </div>
    </header>

    <main>
      <section class="text-center container">
        <div class="row py-lg-5">
          <div class="col-lg-6 col-md-8 mx-auto">
            <h3 class="p-2">Masukkan data transaksi dibawah ini!</h3>
            <form id="crud-form" method="post" action="assets/php/add.php">
              <div class="form-group">
                <label for="jumlah_transaksi">Jumlah Transaksi</label>
                <input type="text" class="form-control" name="jumlah_transaksi" placeholder="Enter Jumlah Transaksi">
              </div>
              <div class="form-group">
                <label for="tgl_transaksi">Tanggal Transaksi</label>
                <input type="date" class="form-control" name="tgl_transaksi">
              </div>
              <div class="form-group">
                <label for="deskripsi_transaksi">Deskripsi Transaksi</label>
                <textarea class="form-control" name="deskripsi_transaksi" rows="3" placeholder="Enter Deskripsi Transaksi"></textarea>
              </div>
              <div class="form-group">
                <label for="jenis_transaksi">Jenis Transaksi</label>
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
                <div class="app-card app-card-orders-table shadow-sm mb-5">
                  <div class="app-card-body">
                    <div class="table-responsive">
                      <table class="table app-table-hover mb-0 text-left">
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
                            foreach ($result = mysqli_fetch_all($request) as $index) {
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
                          ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                <nav class="app-pagination">
                  <ul class="pagination justify-content-center">
                    <li class="page-item disabled">
                      <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                    </li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                      <a class="page-link" href="#">Next</a>
                    </li>
                  </ul>
                </nav>
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
                <h5 class="modal-title" id="exampleModalLabel">Konfirmasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <p>Apakah anda yakin ingin menghapus data transaksi ini?</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn app-btn-secondary" data-dismiss="modal">Close</button>
                <form action="" method="GET" id="conDeleteTransaksi">
                  <input type="submit" id="submit" name="deleteButton" class="btn app-btn-confirmation" value="Ya, saya yakin">
                </form>
              </div>
            </div>
          </div>
        </div>

        <!-- Modal Update -->
        <div class="modal fade" id="edit-transaksi" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Konfirmasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <p>Edit Iklan Ini?</p>
                <form action="" method="GET" id="conEditTransaksi">
                  <label for="release">
                    Date Release :
                    <input type="date" name="date-release" required>
                  </label>
                  <label for="expired">
                    Date Expired :
                    <input type="date" name="date-expired" required>
                  </label>
                  <br>
                  <input type="submit" id="submit" name="editButton" class="btn app-btn-primary mt-2" value="Ya, saya yakin">
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn app-btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Footer -->
  <footer class="text-body-secondary py-5">
    <div class="container">
      <p class="float-end mb-1">
        <a class="btn btn-secondary my-2" href="#">Back to top</a>
      </p>
    </div>
  </footer>

  <script src="assets/dist/js/bootstrap.bundle.min.js"></script> 
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="assets/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/color-modes.js"></script>
  <script src="assets/js/jquery.min.js"></script>
  <script defer src="assets/plugins/fontawesome/js/all.min.js"></script>
  <script src="assets/plugins/popper.min.js"></script>
  <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/js/app.js"></script>
  <script src="assets/js/manage.js"></script>
  </body>
</html>