<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-form-container {
            background-color: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        .login-form-title {
            font-size: 1.2rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
            display: block;
        }

        .login-form-input {
            width: 100%;
            padding: 0.5rem;
            margin-bottom: 1rem;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 1rem;
        }

        .login-form-input:focus {
            outline: none;
            border-color: #007bff;
        }

        .login-button {
            width: 100%;
            padding: 0.75rem;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .login-button:hover {
            background-color: #0056b3;
        }

        .login-form-group {
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
    <div class="login-form-container">
        <h2>Login</h2>
        <form action="" method="post">
            <div class="login-form-group">
                <label for="username" class="login-form-title">Username</label>
                <input type="text" id="username" name="username" class="login-form-input" required>
            </div>
            <div class="login-form-group">
                <label for="password" class="login-form-title">Password</label>
                <input type="password" id="password" name="password" class="login-form-input" required>
            </div>
            <button type="submit" name="submit" class="login-button">Login</button>
        </form>
        <p>Belum punya akun? <a href="registrasi.php">Daftar di sini</a></p>
    </div>

    <?php 
session_start();
include "services/database.php";

if(isset($_POST["submit"])){
    $username = mysqli_real_escape_string($db, $_POST["username"]);
    $password = $_POST["password"];

    $query = "SELECT * FROM users WHERE username = ?";
    $stmt = mysqli_prepare($db, $query);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if(mysqli_num_rows($result) == 1){
        $user = mysqli_fetch_assoc($result);
        if(password_verify($password, $user['password'])){
            $_SESSION['login'] = true;
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];
            
            header("Location: index.php");
            exit();
        } else {
            echo "<script>alert('Password salah');</script>";
        }
    } else {
        echo "<script>alert('Username tidak ditemukan');</script>";
    }
}
?>
</body>
</html>

