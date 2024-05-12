<?php

session_start();

if (! isset($_SESSION['username'])) {
    header('Location: login.php');
}elseif (! isset($_SESSION['penulis'])) {
    header('Location: index.php');
}
require 'dbconn.php';
$lists = query('SELECT * FROM kategori_naskah');

// jika array $_POST memiliki item "submit",..
if (isset ($_POST['submit'])) {

    upfile($_POST);
    
}

?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Independent Project</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- My Stylesheet -->
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

    <header>

        <div class="jumbotron">
  
          <h1>Samarinda</h1>
          <p>
            Selamat datang, penulis <b><?php echo $_SESSION['username']?></b> 
          </p>
          
          
            
        </div>
        
        <nav>
  
          <ul>
            <li> <a href="#geografis">Inbox</a></li>
            <li> <a id="logout" href="logout.php">Log out</a></li>
          </ul>
  
        </nav>

        
      </header>
      
      <main>
        <div class="content">
            <article class="card">
                <div class="w-50 m-auto">
    
                    <h2 class="text-dark">Silahkan upload naskah Anda!</h2>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="mb-3">
                                <label for="judul_naskah" class="form-label">Judul Naskah</label>
                                <input name="judul_naskah" id="judul_naskah" type="text" class="form-control" placeholder="Tuliskan judul naskah..">
                            </div>
                            <div class="mb-3">
                                <label for="nama_penulis" class="form-label">Nama Penulis</label>
                                <input name="nama_penulis" id="nama_penulis" type="text" class="form-control" placeholder="Tuliskan nama penulis..">
                            </div>

                            <div class="mb-3">
                                <label for="kategori" class="form-label">Kategori</label>
                                <select name="kategori" id="kategori" class="form-select" aria-label="Default select example">
                                    <option selected>Pilih kategori naskah</option>

                                    <?php foreach ($lists as $list) : ?>
                                        <option value=<?= $list['id_kategori'] ?>><?= $list['nama'] ?></option>
                                    <?php endforeach ?>
 
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="formFile" class="form-label">Lampiran naskah</label>
                                <input name="file" class="form-control" type="file" id="formFile">
                            </div>
                            
                            
                            
                        </div>
                    </form>
                    
                </div>
            </article>
        </div>
        
        </main>
  
        <footer>
            <p>Adli Imam Suryadin &copy; 2024, Universitas Mulawarman</p>
        </footer>
    
        
        
        <?php if (isset($_SESSION['succeed'])):?>
        
            <script type="text/javascript">
                function createFaction() {
                    document.getElementById('test1').innerHTML = "BISA!";
                }
            </script>
        <?php elseif (isset($_SESSION['failed'])):?>
        
        <script type="text/javascript">
            function createFaction() {
                document.getElementById('test1').innerHTML = factionName;
            }
        </script>
        <?php elseif (isset($_SESSION['too_big'])):?>
        
        <script type="text/javascript">
            function createFaction() {
                document.getElementById('test1').innerHTML = factionName;
            }
        </script>
        <?php elseif (isset($_SESSION['wrong_file'])):?>
        
        <script type="text/javascript">
            function createFaction() {
                document.getElementById('test1').innerHTML = "File salah!";
            }
        </script>

        <?php endif;?>
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>