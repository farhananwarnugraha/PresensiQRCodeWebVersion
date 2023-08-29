<?php
  require '../connection.php';
  session_start();
  if($_SESSION['status']!="login"){
      header("location:../index.php?pesan=belum_login");
  }
  //mengambil data dari tabel guru
  $absen = query ("SELECT presensi_mapel.id_presensi,presensi_mapel.nama_mapel,presensi_mapel.waktu_presensi,presensi_mapel.keterangan,presensi_mapel.siswa,siswa.id_siswa,siswa.nis_siswa,siswa.nama_siswa,siswa.kelas_siswa,siswa.jurusan_siswa,kelas.id_kelas,kelas.nama_kelas,jurusan.id_jurusan,jurusan.nama_jurusan,matapelajaran.id_mapel,matapelajaran.nama_mapel 
                  FROM `presensi_mapel` JOIN siswa ON siswa.id_siswa = presensi_mapel.siswa 
                  JOIN matapelajaran ON matapelajaran.id_mapel = presensi_mapel.nama_mapel 
                  JOIN kelas ON kelas.id_kelas = siswa.kelas_siswa 
                  JOIN jurusan ON jurusan.id_jurusan = siswa.jurusan_siswa");

  $mapel = query("SELECT * FROM matapelajaran");
  // $absen = query ("SELECT * FROM siamad_absen ");
  // $absen = query ("SELECT absen_siamad.`nis_siswa`, siamad_siswa.`nama_siswa`, siamad_kelas.`nama_kelas`,absen_siamad.`keterangan`
  // FROM absen_siamad JOIN siamad_siswa ON absen_siamad.`nis_siswa` = siamad_siswa.`nis_siswa` 
  // JOIN siamad_kelas ON siamad_kelas.`kode_kelas` = siamad_siswa.`kelas_siswa` ");
  $siswa = query ("SELECT * FROM siswa");
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
              <a class="nav-link px-3 sidebar-link " data-bs-toggle="collapse" href="#datamaster" role="button" aria-expanded="false" aria-controls="collapseExample">
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
                      <a href="admin_murid.php" class="nav-link px-4 "> Data Siswa </a>
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
    <main class="mt-5 shadow pb-1 mb-5 bg-body rounded">
      <div class="container-fluid">
        <div class="row mt-0 pt-3 shadow p-3 mb-4 bg-body rounded">
          <div class="col md-12 fw-bold fs-3">Daftar Kehadiran</div>
        </div>
        <!-- Btn Tambah data with Modal-->
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-success fw-bold" data-bs-toggle="modal" data-bs-target="#exampleModal">
        <i class="bi bi-plus"></i>
          Tambah Absensi
        </button>
        <a href="admin_absen.php" type="button" class="btn btn-secondary fw-bold">
        <i class="bi bi-file-check-fill"></i>
          Presensi Masuk
        </a>
        <a href="presensimapel.php" type="button" class="btn btn-info fw-bold">
        <i class="bi bi-file-check-fill"></i>
          Presensi Matapelajaran
        </a>
        <!-- Filter absen mapel -->
        <form method="GET" class="mt-3 align-right">
            <div class="mb-1 col-5">
              <select id="kelas_siswa" name="mapel" class="form-select" aria-label="Default select example">
                <option selected>Pilih Mapel</option>
                  <?php
                    foreach ($mapel as $row) :
                  ?>
                <option value="<?= $row['id_mapel']?>"><?=$row['nama_mapel']?></option>
                  <?php
                    endforeach
                  ?>
              </select>
            </div>
            <button type="submit" name="tampil" class="btn btn-outline-info fw-bold mt-1 my-0 mb-2">
              Tampil
            </button>
          </form>
          <?php
          if( isset($_GET['tampil'] )){
            //query
            $absen = query("SELECT presensi_mapel.id_presensi,presensi_mapel.nama_mapel,presensi_mapel.waktu_presensi,presensi_mapel.keterangan,presensi_mapel.siswa,siswa.id_siswa,siswa.nis_siswa,siswa.nama_siswa,siswa.kelas_siswa,siswa.jurusan_siswa,kelas.id_kelas,kelas.nama_kelas,jurusan.id_jurusan,jurusan.nama_jurusan,matapelajaran.id_mapel,matapelajaran.nama_mapel 
            FROM `presensi_mapel` JOIN siswa ON siswa.id_siswa = presensi_mapel.siswa 
            JOIN matapelajaran ON matapelajaran.id_mapel = presensi_mapel.nama_mapel 
            JOIN kelas ON kelas.id_kelas = siswa.kelas_siswa 
            JOIN jurusan ON jurusan.id_jurusan = siswa.jurusan_siswa
            WHERE presensi_mapel.`nama_mapel`='$_GET[mapel]'");
            // var_dump($absen);
            // exit;
          }
           
          else{
            //query
            $absen = query("SELECT presensi_mapel.id_presensi,presensi_mapel.nama_mapel,presensi_mapel.waktu_presensi,presensi_mapel.keterangan,presensi_mapel.siswa,siswa.id_siswa,siswa.nis_siswa,siswa.nama_siswa,siswa.kelas_siswa,siswa.jurusan_siswa,kelas.id_kelas,kelas.nama_kelas,jurusan.id_jurusan,jurusan.nama_jurusan,matapelajaran.id_mapel,matapelajaran.nama_mapel 
            FROM `presensi_mapel` JOIN siswa ON siswa.id_siswa = presensi_mapel.siswa 
            JOIN matapelajaran ON matapelajaran.id_mapel = presensi_mapel.nama_mapel 
            JOIN kelas ON kelas.id_kelas = siswa.kelas_siswa 
            JOIN jurusan ON jurusan.id_jurusan = siswa.jurusan_siswa");
          }
        ?>
        <!-- akhir logic filter -->
        <!-- awal menekan button input absen -->
        <?php
          if( isset($_POST['submit'] )){

            if (absen_mapel($_POST) >0) {
              echo "
                <script>
                alert('Absen Berhasil Ditambahkan');
                document.location='presensimapel.php?status=sukses';
                </script>";
            }
            else{
              echo "
                <script>
                alert('Absen Gagal Ditambahkan');
                document.location='presensimapel.php?status=gagal';
                </script>";
            }
          }
        ?>
        <!-- akhir button input absen -->
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="">Tambah Absensi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <!-- Form tambah data -->
                <form action=" " method="POST">
                  <div class="mb-3">
                    <label for="nis_siswa" class="form-label">NIS Siswa</label>
                    <select id="nis_siswa" name="nis_siswa" class="form-select" aria-label="Default select example">
                    <option selected>NIS Siswa</option>
                    <?php
                      foreach ($siswa as $row) :
                    ?>
                    <option value="<?= $row['id_siswa']?>"><?= $row['nis_siswa']?>-<?= $row['nama_siswa']?></option>
                    <?php
                    endforeach
                    ?>
                  </select>
                  </div>
                  <div class="mb-3">
                    <label for="tgl-absen" class="form-label">Tanggal </label>
                    <input type="date" class="form-control" id="tgl-absen" name="tgl_absen" aria-describedby="namamapel">
                  </div>
                  <div class="mb-3">
                    <label for="nama_mapel" class="form-label">Waktu Absen</label>
                    <input type="time" class="form-control" id="nama_mapel" name="waktu_presensi" aria-describedby="namamapel" required>
                  </div>
                  <div class="mb-3">
                    <label for="keterangan" class="form-label">Matapelajaran</label>
                    <select id="keterangan" name="nama_mapel" class="form-select" aria-label="Default select example">
                      <option selected>Pilih Mapel</option>
                      <?php
                      foreach ($mapel as $row) :
                      ?>
                      <option value="<?= $row['id_mapel']?>"><?= $row['nama_mapel']?></option>
                      <?php
                      endforeach
                      ?>
                    </select>
                  </div>
                  <div class="mb-3">
                    <label for="keterangan" class="form-label">Keterangan</label>
                    <select id="keterangan" name="keterangan" class="form-select" aria-label="Default select example">
                      <option selected>Pilih Keterangan</option>
                      <option value="Hadir">Hadir</option>
                      <option value="Izin">Izin</option>
                      <option value="Sakit">Sakit</option>
                      <option value="Alpa">Alpa</option>
                    </select>
                  </div>
                  <button type="submit" name="submit" class="btn btn-primary mt-1">Submit</button>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
              </div>
            </div>
          </div>
        </div>
        <!-- Btn Tambah Data with Modal -->
        <!-- Tabel Guru -->
        <table class="table table-striped table-hover border rounded mt-3 pt-3 shadow p-3 mb-5 bg-body rounded ">
        <thead class="text-center align-middle">
          <tr>
            <th scope="col">No</th>
            <th scope="col">NIS Siswa</th>
            <th scope="col">Nama Siswa</th>
            <th scope="col">Kelas</th>
            <th scope="col">Jurusan</th>
            <th scope="col">Matapelajaran</th>
            <!-- <th scope="col">Pertemuan</th> -->
            <th scope="col">Waktu Absen</th>
            <th scope="col">Keterangan</th>
            <th scope="col">Action</th>
          </tr>
          </thead>
          <tbody>
          <?php $i=1; ?>
          <?php
             foreach ($absen as $row) :
          ?>
            <tr>
              <th scope="row" class="text-center"><?= $i; ?></th>
              <td class="text-center"><?= $row['nis_siswa']?></td>
              <td><?= $row['nama_siswa']?></td>
              <td class="text-center"><?= $row['nama_kelas']?></td>
              <td class="text-center"><?= $row['nama_jurusan']?></td>
              <td class="text-center"><?= $row['nama_mapel']?></td>
              <td class="text-center"><?= $row['waktu_presensi']?></td>
              <td class="text-center"><?= $row['keterangan']?></td>
              <td class="text-center">
                <a href="editabsenmapel.php?id=<?= $row['id_presensi']?>" type="button" class="btn btn-warning btn-sm">
                  <i class="bi bi-pencil-square"></i>
                  Ubah
                </a>
              </td>
            </tr>
            <?php $i++; ?>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </main>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>