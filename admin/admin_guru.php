<?php
  require '../connection.php';

  //mengambil data dari tabel guru
  session_start();
  if($_SESSION['status']!="login"){
      header("location:../index.php?pesan=belum_login");
  }

  $guru = query ("SELECT * FROM guru")
  
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
          <img src="../style/logorota.png" alt="" width="30" height="24" class="d-inline-block align-text-top">
          MONITOR-KU SMKN 1 ROTA BAYAT
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
    <main class="mt-5 pt-3 shadow p-3 mb-5 bg-body rounded">
      <div class="container-fluid">
        <div class="row">
          <div class="col md-12 fw-bold fs-3">Daftar Guru</div>
        </div>
        <!-- Btn Tambah data with Modal-->
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-outline-success mb-2 fw-bold" data-bs-toggle="modal" data-bs-target="#exampleModal">
        <i class="bi bi-plus fw-bold"></i>
          Tambah Data
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Guru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <!-- Form tambah data -->
                <?php
                if(isset($_POST["submit"])){
                  //cekdata berhasil ditambahkan
                  if (tambah_guru($_POST) >0) {
                    echo "
                      <script>
                      alert('Data Guru Berhasil Ditambahkan');
                      document.location='admin_guru.php?status=sukses';
                      </script>";
                  }
                  else{
                    echo "
                      <script>
                      alert('Data Guru Gagal Berhasil Ditambahkan');
                      document.location='admin_guru.php?status=gagal';
                      </script>";
                  }

                }
                ?>
                <form action="" method="post">
                  <div class="mb-3">
                    <label for="nip" class="form-label">NIP</label>
                    <input type="text" class="form-control" id="nip" name="nip_guru" aria-describedby="nipguru" placeholder="NIP Guru" required>
                  </div>
                  <div class="mb-3">
                    <label for="nama_guru" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" id="nama_guru" name="nama_guru" aria-describedby="namaguru" placeholder="Nama Lengkap" required>
                  </div>
                  <div class="mb-3">
                    <label for="tanggal_lahir" class="form-label">Alamat Lengkap</label>
                    <textarea type="text-area" class="form-control" id="tanggal_lahir" name="alamat_guru" aria-describedby="lahirguru" required></textarea>
                  </div>
                  <div class="mb-3">
                    <label for="alamat_guru" class="form-label">Kota</label>
                    <input type="text" class="form-control" id="alamat_guru" name="kota_guru" aria-describedby="alamat" placeholder="Asal Kota" required>
                  </div>
                  <div class="mb-3">
                    <label for="tlp_guru" class="form-label">Jenis Kelamin</label>
                    <select id="jk_guru" name="jenis_kelamin" class="form-select" aria-label="Default select example">
                      <option selected>Pilih Jenis Kelamin</option>
                      <option value="Laki-laki">Laki-laki</option>
                      <option value="Peremuan">Perempuan</option>
                    </select>
                  </div>
                  <div class="mb-3">
                    <label for="tlp_guru" class="form-label">No.Telepon</label>
                    <input type="text" class="form-control" id="tlp_guru" name="no_tlp" aria-describedby="telepon" placeholder="No.Telepon : +6289-xxxx-xxxx" required>
                  </div>
                  <!-- <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1"name="pass_guru" required>
                  </div> -->
                  <button type="submit" name="submit" class="btn btn-outline-success">Submit</button>
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
        <table class="table text-center border ">
          <thead class="text-center align-middle">
          <tr>
            <th scope="col">No</th>
            <th scope="col">NIP Guru</th>
            <th scope="col">Nama Guru</th>
            <th scope="col">Alamat</th>
            <th scope="col">Jenis Kelamin</th>
            <th scope="col">No Telephon</th>
            <th scope="col">Action</th>
          </tr>
          </thead>
          <tbody>
            <?php $i=1; ?>
            <?php
             foreach ($guru as $row) :
            ?>
            <tr class="align-middle">
              <th scope="row" ><?= $i; ?></th>
              <td><?= $row['nip_guru'] ?></td>
              <td><?= $row['nama_guru'] ?></td>
              <td><?= $row['alamat_guru'] . " " . $row['kota_guru']?></td>
              <td><?= $row['jenis_kelamin']?></td>
              <td><?= $row['no_tlp']?></td>
              <td class="text-center">
                <a href="edit_guru.php?id_guru=<?= $row['id_guru']?>" type="button" class="btn btn-warning btn-sm mb-1">
                  <i class="bi bi-pencil-square"></i>
                  Ubah
                </a>
                <a href="hapus_data.php?id_guru=<?= $row['id_guru']?>" onclick="return confirm('Apakah Anda ingin menghapus data ini ?')" type="button" class="btn btn-danger btn-sm">
                  <i class="bi bi-trash3-fill"></i>
                  Hapus
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
