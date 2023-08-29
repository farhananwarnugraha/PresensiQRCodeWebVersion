<?php
  require '../connection.php';
  session_start();
  if($_SESSION['status']!="login"){
      header("location:../index.php?pesan=belum_login");
  }
  
  $kode = $_GET['id_izin'];
  //Query data guru berdasarkan id
  $dataabsen = query("SELECT perizinan.`id_izin`, perizinan.`siswa`, perizinan.`kerterangan_izin`,perizinan.nama_gambar,
                      perizinan.`status`,perizinan.tgl_pengajuan_izin,perizinan.gambar_bukti,siswa.`id_siswa`,siswa.nis_siswa ,siswa.`nama_siswa`,siswa.`kelas_siswa`,
                      siswa.`jurusan_siswa`,kelas.`id_kelas`,kelas.`nama_kelas`,jurusan.`id_jurusan`,
                      jurusan.`nama_jurusan` 
                    FROM perizinan 
                    JOIN siswa ON siswa.`id_siswa` = perizinan.`siswa` 
                    JOIN kelas ON kelas.`id_kelas` = siswa.`kelas_siswa` 
                    JOIN jurusan ON jurusan.`id_jurusan` = siswa.`jurusan_siswa`
                    WHERE  perizinan.`id_izin` = $kode")[0];
  
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
    <link rel="stylesheet" href="css/style_admin1.css" />
    <!-- Icon head -->
    <link rel="icon" href="../style/logorota.png" />
    <title>Sistem Monitoring Presensi Siswa</title>
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

    <div class="offcanvas offcanvas-start text-white sidebar-nav" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel" style="background-color: #205E61">
      <div class="offcanvas-body p-0">
        <nav class="navbar-dark">
          <ul class="navbar-nav">
            <hr />
            <li>
              <div class="small fw-bold text-uppercase text-center">Welcome <?php echo $_SESSION['nama_admin']; ?></div>
            </li>
            <hr />
            <li>
              <a href="index.php" class="nav-link px-3 ">
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
                      <a href="admin_guru.php" class="nav-link px-4 "> Data Guru </a>
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
              <a class="nav-link px-3 sidebar-link active" data-bs-toggle="collapse" href="#akademik" role="button" aria-expanded="false" aria-controls="collapseExample">
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
                      <a href="perizinan.php" class="nav-link px-4 active"> Perizinan </a>
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
                <span>Rekap Data</span>
                <span class="right-icon ms-auto">
                  <i class="bi bi-chevron-down"></i>
                </span>
              </a>
              <div class="collapse" id="report">
                <div>
                  <ul class="navbar-nav ps-3">
                    <li>
                      <a href="admin_rekap_absen.php" class="nav-link px-4"> Presensi Siswa </a>
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
    <main class="mt-5 pt-3 shadow p-3 mb-5 bg-body rounded">
      <div class="container-fluid">
        <div class="row">
          <div class="col md-12 fw-bold fs-3">
            <i class="bi bi-pencil-square"></i>
            Ubah Peizinan
          </div>
        </div> 
          <form action="log/eperizinan.php" method="POST">
            <div class="mb-1">
               <input type="text" class="form-control" id="kode_kelas" name="id_izin" hidden aria-describedby="kode_kelas" readonly value="<?= $dataabsen['id_izin']?>">
            </div>
            <div class="mb-1">
               <input type="text" class="form-control" id="kode_kelas" name="siswa" hidden aria-describedby="kode_kelas" readonly value="<?= $dataabsen['siswa']?>">
            </div>
            <div class="mb-1">
              <label for="nama_kelas" class="form-label fw-bold fs-6">NIS Siswa</label>
              <input type="text" class="form-control" id="nama_kelas" readonly name="nis_siswa" aria-describedby="nama_kelas" value="<?= $dataabsen['nis_siswa']?>">
            </div>
            <div class="mb-1">
              <label for="nama_kelas" class="form-label fw-bold fs-6">Nama Siswa</label>
              <input type="text" class="form-control" id="nama_kelas" readonly name="nama_siswa" aria-describedby="nama_kelas" value="<?= $dataabsen['nama_siswa']?>">
            </div>
            <div class="mb-1">
              <input type="text" class="form-control" id="nama_kelas" name="siswa" aria-describedby="nama_kelas" hidden value="<?= $dataabsen['siswa']?>">
            </div>
            <div class="mb-1">
              <label for="nama_kelas" class="form-label fw-bold fs-6">Tanggal Pengajuan Izin</label>
              <input type="text" class="form-control" id="nama_kelas" readonly name="tgl_izin" aria-describedby="nama_kelas" value="<?= $dataabsen['tgl_pengajuan_izin']?>">
            </div>
            <div class="mb-1">
              <label for="nama_kelas" class="form-label fw-bold fs-6">Bukti Izin</label> <br>
              <img src='data:image/jpeg;base64,<?= base64_encode($dataabsen['gambar_bukti']) ?>' alt='Gambar Bukti' width=300>
            </div>
            <div class="mb-1">
              <label for="nama_kelas" class="form-label fw-bold fs-6">Alasan Tidak Masuk</label>
              <input type="text" class="form-control" id="nama_kelas" name="keterangan_izin" readonly aria-describedby="nama_kelas" value="<?= $dataabsen['kerterangan_izin']?>">
            </div>
            <div class="mb-1">
              <label for="guru_kelas" class="form-label fw-bold">Status</label>
              <select id="guru_kelas" name="status" class="form-select" aria-label="Default select example">
                <option selected value="<?= $dataabsen['status']?>"><?= $dataabsen['status']?></option>
                <option value="Acc">ACC</option>
                <option value="Reject">REJECT</option>
              </select>
            </div>
            <button type="submit" name="submit" class="btn btn-warning fw-bold mt-2">Ubah</button>
          </form>
      </div>
    </main>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>
