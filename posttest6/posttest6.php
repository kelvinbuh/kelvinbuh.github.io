<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengenalan Alat Musik Tradisional</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
            transition: background-color 0.5s;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 1em;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 1.8em;
            font-weight: bold;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .navbar {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
        }

        .navbar li {
            margin-right: 30px;
        }

        .navbar a {
            color: #fff;
            text-decoration: none;
            font-size: 1.1em;
            transition: color 0.3s;
        }

        .navbar a:hover {
            color: #ffa500;
        }

        main {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 2em;
            animation: fadeIn 1s;
        }

        section {
            background-color: #fff;
            padding: 1.5em;
            margin-bottom: 20px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            transition: transform 0.3s;
            width: 80%;
        }

        h1, h2 {
            margin-top: 0;
            color: #333;
        }

        button {
            background-color: #333;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s;
            margin: 0 10px;
        }

        button:hover {
            background-color: #555;
        }

        footer {
            background-color: #333;
            color: #fff;
            padding: 1em;
            text-align: center;
            clear: both;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        #data-container {
            display: none;
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <div class="logo">Pengenalan Alat Musik Tradisional</div>
            <ul class="navbar">
                <li><a href="#home">Beranda</a></li>
                <li><a id="tentang-saya">Tentang Saya</a></li>
            </ul>
        </nav>
    </header>
    <main id="main-content">
        <section id="home">
            <h1>Selamat Datang di Website Pengenalan Alat Musik Tradisional</h1>
            <p>Website ini dibuat untuk memperkenalkan alat musik tradisional Indonesia.</p>
        </section>

        <section>
            <h1>Formulir Pengenalan Alat Musik</h1>
            <p>Silakan isi data berikut untuk mempelajari alat musik tradisional:</p>

            <form method="POST" action="" enctype="multipart/form-data">
                <input type="hidden" id="user_id" name="user_id" value="<?php echo isset($user_id) ? $user_id : ''; ?>">
                
                <label for="nama">Nama:</label><br>
                <input type="text" id="nama" name="nama" required value="<?php echo isset($nama) ? $nama : ''; ?>"><br><br>

                <label for="usia">Usia:</label><br>
                <input type="number" id="usia" name="usia" required value="<?php echo isset($usia) ? $usia : ''; ?>"><br><br>

                <label for="password">Kata Sandi:</label><br>
                <input type="password" id="password" name="password" placeholder="Kosongkan jika tidak diubah"><br><br>

                <label for="file_upload">Unggah File:</label><br>
                <input type="file" id="file_upload" name="file_upload"><br><br>

                <input type="submit" value="<?php echo isset($user_id) ? 'Perbarui' : 'Kirim'; ?>">
            </form>

            <?php
            include 'koneksi.php'; 

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $user_id = isset($_POST['user_id']) ? htmlspecialchars($_POST['user_id']) : '';
                $nama = htmlspecialchars($_POST['nama']);
                $usia = htmlspecialchars($_POST['usia']);
                $password = !empty($_POST['password']) ? password_hash(htmlspecialchars($_POST['password']), PASSWORD_DEFAULT) : null;

                if (isset($_FILES['file_upload']) && $_FILES['file_upload']['error'] === 0) {
                    $file = $_FILES['file_upload'];
                    $fileName = $file['name'];
                    $fileTmp = $file['tmp_name'];
                    $fileExt = pathinfo($fileName, PATHINFO_EXTENSION);

                    $newFileName = date('Y-m-d H.i.s') . '.' . $fileExt;
                    $uploadPath = 'uploads/' . $newFileName;

                    move_uploaded_file($fileTmp, $uploadPath);
                }

                if ($user_id) {
                    if ($password) {
                        $sql = "UPDATE users SET nama_user='$nama', usia='$usia', password='$password', file='$newFileName' WHERE id_user='$user_id'";
                    } else {
                        $sql = "UPDATE users SET nama_user='$nama', usia='$usia', file='$newFileName' WHERE id_user='$user_id'";
                    }
                } else {
                    $sql = "INSERT INTO users (nama_user, usia, password, file) VALUES ('$nama', '$usia', '$password', '$newFileName')";
                }

                if (mysqli_query($kon, $sql)) {
                    echo "Data berhasil disimpan!";
                } else {
                    echo "Terjadi kesalahan: " . mysqli_error($kon);
                }
            }

            if (isset($_GET['delete'])) {
                $id = $_GET['delete'];
                $result = mysqli_query($kon, "SELECT file FROM users WHERE id_user='$id'");
                $row = mysqli_fetch_assoc($result);
                if ($row['file']) {
                    unlink('uploads/' . $row['file']); 
                }
                
                $sql = "DELETE FROM users WHERE id_user='$id'";
                if (mysqli_query($kon, $sql)) {
                    echo "Data berhasil dihapus!";
                } else {
                    echo "Terjadi kesalahan: " . mysqli_error($kon);
                }
            }

            if (isset($_GET['edit'])) {
                $user_id = $_GET['edit'];
                $result = mysqli_query($kon, "SELECT * FROM users WHERE id_user='$user_id'");
                $user = mysqli_fetch_assoc($result);
                $nama = $user['nama_user'];
                $usia = $user['usia'];
            }
            ?>
        </section>

        <section>
            <h1>Data Pengguna</h1>
            <button id="toggle-data">Tampilkan Data</button>
            <div id="data-container">
                <table>
                    <tr>
                        <th>Nama</th>
                        <th>Usia</th>
                        <th>File</th>
                        <th>Aksi</th>
                    </tr>
                    <?php
                    $query = "SELECT * FROM users"; 
                    $result = mysqli_query($kon, $query);

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row['nama_user'] . "</td>";
                            echo "<td>" . $row['usia'] . "</td>";
                            echo "<td><a href='uploads/" . $row['file'] . "' target='_blank'>" . $row['file'] . "</a></td>";
                            echo "<td>
                                    <a href='?edit=" . $row['id_user'] . "'>Edit</a> | 
                                    <a href='?delete=" . $row['id_user'] . "' onclick=\"return confirm('Apakah Anda yakin ingin menghapus data ini?')\">Hapus</a>
                                  </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4'>Belum ada data pengguna.</td></tr>";
                    }
                    ?>
                </table>
            </div>
        </section>
    </main>
    <footer>
        <p>&copy; 2024 Pengenalan Alat Musik Tradisional</p>
    </footer>
    <script>
        document.getElementById("toggle-data").addEventListener("click", function() {
            var dataContainer = document.getElementById("data-container");
            if (dataContainer.style.display === "none") {
                dataContainer.style.display = "block";
                this.textContent = "Sembunyikan Data";
            } else {
                dataContainer.style.display = "none";
                this.textContent = "Tampilkan Data";
            }
        });
    </script>
</body>
</html>







