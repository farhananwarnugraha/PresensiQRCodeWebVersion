<?php
    require '../connection.php';

    if(isset($_POST["ubah"])){
      $id_siswa = $_POST['id_siswa'];
      $nis_siswa = $_POST['nis_siswa'];
      $nama_siswa =$_POST['nama_siswa'];
      $alamat_lengkap =$_POST['alamat_siswa'];
      $asal_kota =$_POST['kota_siswa'];
      $lahir_siswa = $_POST['tgl_lahir'];
      $no_tlp = $_POST['no_tlp'];
      $kelas_siswa = $_POST['kelas_siswa'];
      $jurusan_siswa =$_POST['jurusan_siswa'];
      $pass_siswa = md5($_POST['pass_siswa']);
      //var_dump($id_siswa,$nis_siswa,$nama_siswa,$alamat_lengkap,$asal_kota,$lahir_siswa,$no_tlp,$kelas_siswa,$jurusan_siswa,$pass_siswa);
  
      $update= "UPDATE siswa SET 
                id_siswa = '$id_siswa',
                nis_siswa = '$nis_siswa', 
                nama_siswa = '$nama_siswa', 
                alamat_siswa = '$alamat_lengkap',
                kota_siswa = '$asal_kota',
                tgl_lahir = '$lahir_siswa',
                no_tlp = '$no_tlp',
                kelas_siswa = '$kelas_siswa',
                jurusan_siswa = '$jurusan_siswa',
                pass_siswa = '$pass_siswa'
                WHERE id_siswa= '$id_siswa' ";
      $query = mysqli_query($connect, $update);
      // var_dump($quey);
        //cekdata berhasil ditambahkan
        if ($query) {
          echo "
            <script>
            alert('Data Berhasil diupdate');
            document.location='admin_murid.php?status=sukses';
            </script>";
        }
        else{
          echo "
            <script>
            alert('Data Gagal diupdate');
            document.location='admin_murid.php?status=gagal';
            </script>";
        }

      }
      ?>