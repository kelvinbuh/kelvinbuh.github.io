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

select.login-form-input {
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    background-image: url('data:image/svg+xml;utf8,<svg fill="black" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="M7 10l5 5 5-5z"/><path d="M0 0h24v24H0z" fill="none"/></svg>');
    background-repeat: no-repeat;
    background-position-x: 100%;
    background-position-y: 5px;
}


</style>




<form action="" method= "post" class = "login-form-container"> 
    <div class = "login-form-group"> 
        <label for= "username" class = "login-form-title">username</label>
        <input type= "text" placeholder = "username" name = "username" id = "username" class = "login-form-input"/>
    </div>

    <div class = "login-form-group"> 
        <label for = "password" class = "login-form-title"> password </label>
        <input type = "password" placeholder = "password" name = "password" id = "password" class = "login-form-input"/>
    </div>

    <div class = "login-form-group">
        <label for = "role" class = "login-form-title">Role></label>
        <select name = "role" id = "role" class = "login-form-input" required>
            <option name = "role" value = "admin"> admin </option>
            <option name = "role" value = "user"> user </option>
            </select> 
    </div>
    <button type = "submit" name = "submit" class = "Login-button">REGISTER</button>
</form>

<?php 
include "services/database.php";

if(isset($_POST["submit"])){
    $username = mysqli_real_escape_string($db, $_POST["username"]);
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $role = $_POST["role"];

    $checkquery = "SELECT * FROM users WHERE username = ?";
    $stmt = mysqli_prepare($db, $checkquery);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if(mysqli_num_rows($result) > 0){
        echo "<script>alert('Username sudah digunakan');</script>";
    } else {
        $query = "INSERT INTO users (username, password, role) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($db, $query);
        mysqli_stmt_bind_param($stmt, "sss", $username, $password, $role);
        
        if(mysqli_stmt_execute($stmt)){
            echo "<script>alert('Registrasi berhasil'); window.location.href = 'login.php';</script>";
        } else {
            echo "<script>alert('Registrasi gagal');</script>";
        }
    }
}
?>

