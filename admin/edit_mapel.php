<?php
  require '../connection.php';
  session_start();
  if($_SESSION['status']!="login"){
      header("location:../index.php?pesan=belum_login");
  }

  $id_mapel = $_GET['id_mapel'];
  //Query data guru berdasarkan id
  $data_mapel = query("SELECT matapelajaran.id_mapel,matapelajaran.nama_mapel,matapelajaran.guru_mapel,matapelajaran.kategori_mapel,guru.id_guru,guru.nama_guru, jurusan.id_jurusan, jurusan.nama_jurusan 
                        FROM matapelajaran 
                        JOIN guru ON guru.id_guru = matapelajaran.guru_mapel 
                        JOIN jurusan ON jurusan.id_jurusan = matapelajaran.kategori_mapel
                        WHERE id_mapel = '$id_mapel'")[0];
  $guru = query("SELECT * FROM guru");
  $kategori = query("SELECT * FROM jurusan");
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
              <a class="nav-link px-3 sidebar-link active" data-bs-toggle="collapse" href="#datamaster" role="button" aria-expanded="false" aria-controls="collapseExample">
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
                      <a href="admin_guru.php" class="nav-link px-4 active"> Data Guru </a>
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
                      <a href="admin_mapel.php" class="nav-link px-4 active"> Matapelajaran </a>
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
                <span>Rekap Data</span>
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
    <main class="mt-5 pt-3 shadow p-3 mb-5 bg-body rounded">
      <div class="container-fluid">
        <div class="row">
          <div class="col md-12 fw-bold fs-3">
            <i class="bi bi-pencil-square"></i>
            Edit Daftar Matapelajaran
          </div>
        </div>
          <form action="log_edit_mapel.php" method="POST">
            <div class="mb-1">
               <input type="text" class="form-control" id="kd_mapel" name="id_mapel" aria-describedby="kd_mapel" hidden value="<?= $data_mapel['id_mapel']?>">
            </div>
            <div class="mb-1">
              <label for="nama_mapel" class="form-label fw-bold fs-6">Nama Mata Pelajaran</label>
              <input type="text" class="form-control" id="nama_mapel" name="nama_mapel" aria-describedby="nama_mapel" value="<?= $data_mapel['nama_mapel']?>">
            </div>
            <div class="mb-1">
              <label for="kurikulum" class="form-label fw-bold">Pengampu Mata Pelajaran</label>
              <select id="kurikulum" name="guru_mapel" class="form-select" aria-label="Default select example">
                <option selected value="<?= $data_mapel['guru_mapel']?>"><?= $data_mapel['nama_guru']?></option>
                <?php
                    foreach ($guru as $row) :
                ?>
                <option value="<?= $row['id_guru']?>"><?=$row['nama_guru']?></option>
                <?php
                  endforeach
                ?>
              </select>
            </div>
            <div class="mb-1">
              <label for="kurikulum" class="form-label fw-bold">Kategori Matapelajaran</label>
              <select id="kurikulum" name="kategori" class="form-select" aria-label="Default select example">
                <option selected value="<?= $data_mapel['id_jurusan']?>"><?= $data_mapel['nama_jurusan']?></option>
                <?php
                    foreach ($kategori as $row) :
                ?>
                <option value="<?= $row['id_jurusan']?>"><?=$row['nama_jurusan']?></option>
                <?php
                  endforeach
                ?>
              </select>
            </div>
            <button type="submit" name="submit" class="mt-2 btn btn-warning fw-bold">Update</button>
          </form>
      </div>
    </main>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>
