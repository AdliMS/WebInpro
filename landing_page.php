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
  
          <h1>Bandung</h1>
          <p>
            Selamat datang, admin <b><?php echo $_SESSION['username']?></b>
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
      
              <h2 class="text-dark">Daftar naskah</h2>

              <table class="table table-light table-bordered w-100 rounded-3 overflow-hidden">

                  <thead>
                      <tr>
                      <th scope="col">No.</th>
                      <th scope="col">Nama buku</th>
                      <th scope="col">Status</th>
                      <th scope="col">Aksi</th>
                      </tr>
                  </thead>

                  <tbody class="table-group-divider">

                  <?php foreach($lists as $list) : ?>

                      <tr>
                      <td scope="col"><?= $list['id_naskah'] ?></td>
                      <td scope="col"><?= $list['judul'] ?></td>
                      <td scope="col"><?= $list['status'] ?></td>
                      <td socket="col" class="col-3">
                          
                          <button name="<?php $list['id_naskah']?>" type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">Edit</button>
                          <a id="hapus" href="delete.php?id=<?= $list['id_naskah'] ?>" class="btn btn-danger">Hapus</a>
                          <a id="hapus" href="delete.php?id=<?= $list['id_naskah'] ?>" class="btn btn-info">Lihat Naskah</a>
                          
                      </td>
                      
                      </tr>
                      
                  <?php endforeach ?>
                  

                  </tbody>

              </table>
    
          </div>
        </article>
      </div>
        
      
        
      </main>
  
      <footer>
        <p>Adli Imam Suryadin &copy; 2024, Universitas Mulawarman</p>
      </footer>
    
</body>
</html>