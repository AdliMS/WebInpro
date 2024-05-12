<?php 

    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'inpro';

    //Buat koneksi
    $conn = mysqli_connect($servername, $username, $password, $database);

    //Cek conn
    if ($conn == null) {
        die('Koneksi Gagal'. mysqli_connect_error());
    }   

    // untuk menampilkan data
    function query($query) {
        global $conn;

        $result = mysqli_query($conn, $query);
        $rows = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }

    // untuk menambah data list
    function add($data) {
        global $conn;

        // mengisi variabel $kegiatan dengan array $_POST yang memiliki name="kegiatan"
        $kegiatan = htmlspecialchars( $data['kegiatan']);

        // melakukan query INSERT INTO ke dalam tabel dengan variabel $kegiatan
        $query = "INSERT INTO list VALUES 
                ('', NULL, '$kegiatan')";
        mysqli_query($conn, $query);
        header("Location: index.php");
    }

    // untuk menambah data user (register)
    function register($data) {
        global $conn;

        // mengisi variabel $kegiatan dengan array $_POST yang memiliki name="kegiatan"
        $email = $data['email'];
        $username = $data['username'];
        $password = $data['password'];
        $password2 = $data['password2'];
        
        // mengecek apakah user telah benar memasukkan konfirmasi password
        if ($password !== $password2) {
            echo "
            <script>
                alert('Harap masukkan password yang sama!');
            </script>
            ";
            return false;
        }

        // // enkripsi password
        // $password = password_hash($password, PASSWORD_DEFAULT);

        // melakukan query INSERT INTO ke dalam tabel dengan variabel $kegiatan
        $query = "INSERT INTO user VALUES 
                ('', '$username', '$email', '$password')";
        mysqli_query($conn, $query);
        header("Location: login.php");
    }

    // untuk mengupdate naskah
    function update_naskah($id_naskah, $status) {
        global $conn;

        $query = "UPDATE naskah
                    SET status = $status
                    WHERE id_naskah = $id_naskah";
        mysqli_query($conn, $query);
        header("Location: index.php");
    }

    function upfile($data) {
        global $conn;

        $ekstensi_diperbolehkan	= array('pdf');
        $judul_buku_raw = $_FILES['file']['name'];
        $judul_buku = $data["judul_naskah"];
        $penulis = $data['nama_penulis'];
        $x = explode('.', $judul_buku_raw);
        $ekstensi = strtolower(end($x));
        $ukuran	= $_FILES['file']['size'];
        $file_tmp = $_FILES['file']['tmp_name'];	

        // mendapatkan id kategori
        $id_kategori = $data['kategori'];

        // mendapatkan id penulis
        $id_penulis = $_SESSION['penulis']['id_penulis'];

        if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
            if($ukuran < 3145728){			
                move_uploaded_file($file_tmp, 'naskah/pending/'.$judul_buku.'.pdf');
                $query = mysqli_query($conn, "INSERT INTO naskah VALUES('', '$id_penulis', '$id_kategori', '$judul_buku', '$penulis', 'Pending')");
                if($query){
                    $_SESSION['succeed'] = true;
                    return $_SESSION['succeed'];
                }else{
                    $_SESSION['failed'] = true;
                    return $_SESSION['failed'];
                }
            }else{
                $_SESSION['too_big'] = true;
                return $_SESSION['too_big'];
            }
        }else{
            $_SESSION['wrong_file'] = true;
            return $_SESSION['wrong_file'];
        }
    }

    function check_perm() {
        global $conn;
        
    }
?>

