<?php 
include "services/database.php";

if(isset($_GET["query"])){
    $query = mysqli_real_escape_string($db, $_GET["query"]);
    $search_query = "SELECT * FROM users WHERE username LIKE '%$query%' OR role LIKE '%$query%'";
    $result = mysqli_query($db, $search_query);

    if(mysqli_num_rows($result) > 0){
        while($user = mysqli_fetch_assoc($result)){
            echo "<p>Username: " . $user['username'] . ", Role: " . $user['role'] . "</p>";
        }
    } else {
        echo "<p>Tidak ada hasil pencarian</p>";
    }
}
?>