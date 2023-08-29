<?php
  //Koneksi PHP
  // require '../connection.php';
  // $jumlah_guru = query("SELECT COUNT(nama_guru) FROM guru_siamad");
  // $jumlah_mapel = query("SELECT COUNT(id_mapel) FROM mapel_siamad");
  // $jumlah_siswa = query("SELECT COUNT(nis_siswa) FROM siswa_siamad");
  // $jumlah_kurikulum = query("SELECT COUNT(id_kurikulum) FROM kurikulum_siamad");
  
  $koneksi = mysqli_connect('localhost','root','','db_presensi');
  
  session_start();
  if($_SESSION['status']!="login"){
      header("location:../index.php?pesan=belum_login");
  }
  // Melihat jumlah yang  Data
  $guru = mysqli_query($koneksi, "SELECT * FROM guru");
  $siswa = mysqli_query($koneksi, "SELECT * FROM siswa");
  $jurusan = mysqli_query($koneksi, "SELECT * FROM jurusan");
  $hadir = mysqli_query($koneksi, "SELECT * FROM presensi_masuk WHERE keterangan = 'Hadir'");
  $sakit = mysqli_query($koneksi, "SELECT * FROM presensi_masuk WHERE keterangan = 'Sakit'");
  $izin = mysqli_query($koneksi, "SELECT * FROM presensi_masuk WHERE keterangan = 'Izin'");
  $alpa = mysqli_query($koneksi, "SELECT * FROM presensi_masuk WHERE keterangan = 'Alpa'");
  
  $jumlah_guru = mysqli_num_rows($guru);
  $jumlah_siswa = mysqli_num_rows($siswa);
  $jumlah_jurusan = mysqli_num_rows($jurusan);
  $jumlah_hadir = mysqli_num_rows($hadir);
  $jumlah_sakit = mysqli_num_rows($sakit);
  $jumlah_izin = mysqli_num_rows($izin);
  $jumlah_alpa = mysqli_num_rows($alpa);

  
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
    <!-- Icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" />
    <!-- Offline Css -->
    <link rel="stylesheet" href="css/style.css" />
    <!-- Icon head -->
    <link rel="icon" href="../style/logorota.png" />
    <title>Sistem Informasi Akademik Madrasah</title>
  </head>
  <body>
    <!-- Nanbar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background-color: #205E61">
      <div class="container-fluid">
        <!-- Offcanvas Trigger -->
        <button class="navbar-toggler btn btn-primary me-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
          <span class="navbar-toggler-icon" data-bs-target="#offcanvasExample"></span>
        </button>
        <!-- offcanvas trigger -->
        <a class="navbar-brand" href="#">
          <img src="../style/logorota.png" alt="logo-navbar" width="30" height="24" class="d-inline-block align-text-top">
          SMKN 1 ROTA BAYAT
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <form class="d-flex ms-auto my-3 my-lg-0">
            <!-- <div class="input-group">
              <input type="text" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="button-addon2" />
              <button class="btn btn-outline-primary bg-primary" type="button" id="button-addon2">
                <i class="bi bi-search" style="color: white"></i>
              </button>
            </div> -->
          </form>
          <ul class="navbar-nav mb-2 mb-lg-0">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-person-fill"></i>
              </a>
              <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="profil.php">Profile</a></li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- navbar -->
    <!-- Offcanvas -->

    <div class="offcanvas offcanvas-start text-white sidebar-nav" style="background-color: #205E61" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
      <div class="offcanvas-body p-0">
        <nav class="navbar-dark">
          <ul class="navbar-nav">
            <hr />
            <li>
              <div class="small fw-bold text-uppercase text-center">Welcome <?php echo $_SESSION['nama_admin']; ?></div>
            </li>
            <hr />
            <li>
              <a href="index.php" class="nav-link px-3 active">
                <span class="me-2">
                  <i class="bi bi-speedometer2"></i>
                </span>
                <span>Dashboard</span>
              </a>
            </li>
            <li class="my-4">
              <hr class="dropdown-divider" />
            </li>
            <li>
              <div class="small fw-bold px-3 pb-3">Main Menu</div>
            </li>

            <li>
              <a class="nav-link px-3 sidebar-link" data-bs-toggle="collapse" href="#datamaster" role="button" aria-expanded="false" aria-controls="collapseExample">
                <span class="me-2">
                  <i class="bi bi-pie-chart"></i>
                </span>
                <span>Data Master</span>
                <span class="right-icon ms-auto">
                  <i class="bi bi-chevron-down"></i>
                </span>
              </a>
              <div class="collapse" id="datamaster">
                <div>
                  <ul class="navbar-nav ps-3">
                    <li>
                      <a href="data_admin.php" class="nav-link px-4"> Data Admin </a>
                    </li>
                    <li>
                      <a href="admin_guru.php" class="nav-link px-4"> Data Guru </a>
                    </li>
                    <li>
                      <a href="admin_murid.php" class="nav-link px-4"> Data Siswa </a>
                    </li>
                    <li>
                      <a href="admin_ortu.php" class="nav-link px-4"> Data Orang Tua Siswa </a>
                    </li>
                  </ul>
                </div>
              </div>
            </li>
            <li>
              <a class="nav-link px-3 sidebar-link" data-bs-toggle="collapse" href="#akademik" role="button" aria-expanded="false" aria-controls="collapseExample">
                <span class="me-2">
                  <i class="bi bi-journals"></i>
                </span>
                <span>Akademik</span>
                <span class="right-icon ms-auto">
                  <i class="bi bi-chevron-down"></i>
                </span>
              </a>
              <div class="collapse" id="akademik">
                <div>
                  <ul class="navbar-nav ps-3">
                    <li>
                      <a href="admin_kelas.php" class="nav-link px-4 "> Kelas </a>
                    </li>
                    <li>
                      <a href="admin_jurusan.php" class="nav-link px-4 "> Jurusan </a>
                    </li>
                    <li>
                      <a href="admin_mapel.php" class="nav-link px-4"> Matapelajaran </a>
                    </li>
                    <li>
                      <a href="admin_absen.php" class="nav-link px-4"> Kehadiran </a>
                    </li>
                    <li>
                      <a href="perizinan.php" class="nav-link px-4"> Perizinan </a>
                    </li>
                    <li>
                      <a href="buatQR.php" class="nav-link px-4"> Buat QR Code </a>
                    </li>
                    <li>
                      <a href="pengumuman.php" class="nav-link px-4"> Pengumuman </a>
                    </li>
                  </ul>
                </div>
              </div>
            </li>
            <li>
              <a class="nav-link px-3 sidebar-link" data-bs-toggle="collapse" href="#report" role="button" aria-expanded="false" aria-controls="collapseExample">
                <span class="me-2">
                  <i class="bi bi-clipboard-data"></i>
                </span>
                <span>Rekap Presensi</span>
                <span class="right-icon ms-auto">
                  <i class="bi bi-chevron-down"></i>
                </span>
              </a>
              <div class="collapse" id="report">
                <div>
                  <ul class="navbar-nav ps-3">
                    <li>
                      <a href="admin_rekap_absen.php" class="nav-link px-4"> Presensi Siswa</a>
                    </li>
                  </ul>
                </div>
              </div>
            </li>
            <li class="my-4">
              <hr class="dropdown-divider" />
            </li>
            <li>
              <div class="small fw-bold px-3 pb-3">Exit</div>
            </li>
            <li>
              <a href="../exit.php" class="nav-link px-3 active">
                <span class="me-2">
                  <span><i class="bi bi-box-arrow-left"></i></span>
                </span>
                <span>Exit</span>
              </a>
            </li>
          </ul>
        </nav>
      </div>
    </div>
    <!-- offcanvas -->
    <main class="mt-5 pt-3">
      <div class="container-fluid">
        <div class="row">
          <div class="col md-12 fw-bold fs-3">Dashboard</div>
        </div>
        <div class="row">
          <div class="col-md-4">
            <div class="card text-white bg-secondary mb-3" style="max-width: 18rem">
              <div class="card-header text-center">Jumlah Siswa</div>
              <div class="card-body">
                <div class="row justify-content-start text-center">
                  <div class="col-5">
                  <i class="bi bi-mortarboard fs-1 opacity-75"></i>
                  </div>
                  <div class="col-5 fs-1"><?php echo $jumlah_siswa; ?></div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-4">
            <div class="card text-white bg-warning mb-3" style="max-width: 18rem">
              <div class="card-header text-center">Jumlah Jurusan</div>
              <div class="card-body">
                <div class="row justify-content-start text-center">
                  <div class="col-5">
                    <i class="bi bi-bookmarks-fill fs-1 opacity-75"></i>
                  </div>
                  <div class="col-5 fs-1"><?php echo $jumlah_jurusan; ?></div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-4">
            <div class="card text-white bg-primary mb-3" style="max-width: 18rem">
              <div class="card-header text-center">Jumlah Guru</div>
              <div class="card-body">
                <div class="row justify-content-start text-center">
                  <div class="col-5">
                    <i class="bi bi-person-plus-fill fs-1 opacity-75"></i>
                  </div>
                  <div class="col-5 fs-1"><?php echo $jumlah_guru; ?></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>

    <main class=" pt-3">
      <div class="container-fluid">
      <div class="row">
          <div class="col pb-2 fw-bold fs-6 align-middle text-center">Rekap Presensi Siswa SMKN 1 ROTA BAYAT</div>
        </div>
        <div class="row">
          <div class="col-md-3">
            <div class="card text-white bg-success mb-3" style="max-width: 18rem">
              <div class="card-header text-center">Siswa Hadir</div>
              <div class="card-body">
                <div class="row justify-content-start text-center">
                  <div class="col-5">
                  <i class="bi bi-trophy fs-1 opacity-75"></i>
                  </div>
                  <div class="col-5 fs-1"><?php echo $jumlah_hadir; ?></div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-3">
            <div class="card text-white bg-secondary mb-3" style="max-width: 18rem">
              <div class="card-header text-center">Siswa Sakit</div>
              <div class="card-body">
                <div class="row justify-content-start text-center">
                  <div class="col-5">
                    <i class="bi bi-hospital-fill fs-1 opacity-75"></i>
                  </div>
                  <div class="col-5 fs-1"><?php echo $jumlah_sakit; ?></div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-3">
            <div class="card text-white bg-warning mb-3" style="max-width: 18rem">
              <div class="card-header text-center">Siswa Izin</div>
              <div class="card-body">
                <div class="row justify-content-start text-center">
                  <div class="col-5">
                    <i class="bi bi-card-text fs-1 opacity-75"></i>
                  </div>
                  <div class="col-5 fs-1"><?php echo $jumlah_izin; ?></div>
                </div>
              </div>
            </div>
          </div>
          
          <div class="col-md-3">
            <div class="card text-white bg-danger mb-3" style="max-width: 18rem">
              <div class="card-header text-center">Siswa Alpa</div>
              <div class="card-body">
                <div class="row justify-content-start text-center">
                  <div class="col-5">
                    <i class="bi bi-x-circle fs-1 opacity-75"></i>
                  </div>
                  <div class="col-5 fs-1"><?php echo $jumlah_alpa; ?></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>
