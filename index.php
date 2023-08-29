<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
    <!-- External Css -->
    <link href="style/stylesheet.css" rel="stylesheet" />
    <link rel="icon" href="style/logorota.png">
    <title>Sistem Informasi Akadmik MI Kertayasa</title>
  </head>
  <body>
    <section style="background-color: #3F979B">
      <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col-12 col-md-8 col-lg-6 col-xl-5 text-center">
          <img class="mb-2" src="style/logorota.png" alt="logo">
          <p class="fw-bolder text-white text-center fs-5 text-uppercase">Sistem Monitoring Presensi Siswa SMK NEGERI 1 ROTA BAYAT</p>
            <div class="card bg-dark text-white" style="border-radius: 1rem">
              <div class="card-body p-5 text-center">
                <div class="mb-md-3 pb-5">
                  <h4 class="fw-bold mb-2 text-uppercase">Login</h4>
                  <p class="text-white-50 mb-4">Silahkan Masuk mengunakan Username dan password</p>
                  <form name="login" action="ceklogin.php" method="POST">
                    <div class="form-outline form-white mb-3">
                      <!-- <label class="form-label" for="typeEmailX">Email</label> -->
                      <input type="text" name="username" id="username" class="form-control form-control-lg text-center" placeholder="Username"  required/>
                    </div>
                    <div class="form-outline form-white mb-3">
                      <!-- <label class="form-label" for="typePasswordX">Password</label> -->
                      <input type="password" name="password" id="pasword" class="form-control form-control-lg text-center" placeholder="Password" required/>
                    </div>
                    <!-- <div class="form-outline form-white mb-3">
                      <select name="level" class="form-select form-select-lg mb-3 text-center bg-secondary text-white" aria-label=".form-select-lg example" required>
                        <option selected>Select User</option>
                        <option value="kepsek">Kepala Sekolah</option>
                        <option value="guru">Guru</option>
                        <option value="admin">Admin</option>
                        <option value="siswa">Siswa</option>
                        <option value="ortu">Orang Tua</option>
                      </select>
                    </div> -->
                    <Button class="btn btn-outline-light btn-lg px-5" name="login" type="submit">LOGIN</Button>
                    <footer class="pt-3">SMKN 1 ROTA BAYAT &copy; 2023</footer>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>
