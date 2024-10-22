<?php
session_start();

if(!isset($_SESSION['login']) || $_SESSION['login'] !== true){
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'] ?? 'User';
?>


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
    </style>
</head>
<body>
    <header>
    <form action="search.php" method="GET">
    <input type="text" name="query" placeholder="Cari...">
    <button type="submit">Cari</button>
</form>
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

            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $nama = htmlspecialchars($_POST['nama']);
                $usia = htmlspecialchars($_POST['usia']);
                $password = htmlspecialchars($_POST['password']);

                echo "<h2>Hasil Inputan:</h2>";
                echo "Nama: " . $nama . "<br>";
                echo "Usia: " . $usia . "<br>";
                echo "Kata Sandi: " . str_repeat("*", strlen($password)) . "<br>";
            }
            ?>
        </section>

        <section class="alat-musik">
            <h2>Alat Musik Tradisional</h2>
            <div class="description">
                <img src="angklung.jpg" alt="Angklung">
                <h3>Angklung</h3>
                <p>Sederhana tapi indah: Angklung dibuat dari bambu dan menghasilkan nada ketika digoyangkan.</p>
            </div>
            <div class="description">
                <img src="gamelan.jpg" alt="Gamelan">
                <h3>Gamelan</h3>
                <p>Orkestra kuno: Gamelan adalah orkestra tradisional Indonesia yang terdiri dari berbagai instrumen.</p>
            </div>
            <div class="description">
                <img src="sasando.jpeg" alt="Sasando">
                <h3>Sasando</h3>
                <p>Unik dari NTT: Sasando adalah alat musik petik dari Pulau Rote, Nusa Tenggara Timur.</p>
            </div>
        </section>
    </main>
    <footer>
        <p>&copy; 2023 Muhamad Kelvin Saputra</p>
    </footer>
</body>
</html>
