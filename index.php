<?php
require_once("header.php");
if(!isset($_SESSION["id"])){
header("Location:login.php");

}else{
$id = $_SESSION["id"];
$query = mysqli_query($connect,"SELECT * FROM users WHERE id=$id");
if(mysqli_num_rows($query) < 1){
header("Location:login.php");
session_destroy();

}else{
$row = mysqli_fetch_assoc($query);
$username =$row["username"];
$email=$row["email"];

}
}

if(isset($_GET["action"]) && $_GET["action"] == "logout"){
session_destroy();
header("Location:login.php");


}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Index</title>
</head>
<body>
    
    <div class="dashbord">
    <?php
    echo "<h1>WELCOME $username</h1>
    <p>Username:$username</p>
    <p>Email:$email</p>
    
    
    ";
    
    ?>
    <a href="index.php?action=logout" class="btn-lg">Logout</a>
    </div>
</body>
</html>