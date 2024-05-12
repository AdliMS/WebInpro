<?php

session_start();

if (isset($_SESSION['username']) && isset($_SESSION['penerbit'])) {
    header('Location: index.php');
} elseif (isset($_SESSION['username']) && isset($_SESSION['penulis'])) {
    header('Location: penulis_page.php');
}
require 'dbconn.php';

if (isset ($_POST['login'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql1 = "SELECT * FROM penerbit WHERE username = '$username' AND password = '$password'";
    $sql2 = "SELECT * FROM penulis WHERE username = '$username' AND password = '$password'";

    $result_penerbit = mysqli_query($conn, $sql1);
    $result_penulis = mysqli_query($conn, $sql2);

    if (mysqli_num_rows($result_penerbit) === 1) {

        $_SESSION['username'] = $username;
        $_SESSION['penerbit'] = $result_penerbit;
        header("Location: index.php");
        exit;
    } elseif (mysqli_num_rows($result_penulis) === 1) {

        $_SESSION['username'] = $username;
        $_SESSION['penulis'] = mysqli_fetch_assoc($result_penulis);
        header("Location: penulis_page.php");
        exit;
    }

    $error = true;
}

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="assets/style.css">
  </head>
  <body class="blueviolet">
    
    <div class="login-heading">
      <h1>Sistem Informasi</h1>
      <h1>Penerbitan Buku</h1>
    </div>
    <div class="container">
      <div class="align-items-center d-flex justify-content-center h-100 mt-100">
          <div class="card login-form mt-100">
              <div class="card-body">
                  <h5 class="card-title text-center">Login</h5>
                  <form action="" method="POST">

                      <div class="mb-3">
                          <label for="username_input" class="form-label">Username</label>
                          <input type="username" class="form-control" id="username_input" name="username">
                      </div>
                      <div class="mb-3">
                          <label for="password_input" class="form-label">Password</label>
                          <input type="password" class="form-control" id="password_input" name="password">
                      </div>

                      <button type="submit" name="login" class="btn blueviolet w-100 text-light">Login</button>

                      <div class="sign-up mt-4">
                          Daftar sebagai penulis <a href="register.php">disini!</a>
                      </div>

                      <?php if (isset ($error)) : ?>
                          <p style="color: red;">Akun tidak ditemukan!</p>    
                      <?php endif ?>

                  </form>
                  
              </div>
              
          </div>
          
      </div>
      
  </div>
    


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>