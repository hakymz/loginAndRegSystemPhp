<?php
require_once "header.php";
if(isset($_SESSION["id"])){
header("Location:index.php");
}

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])){
$username = mysqli_escape_string($connect,$_POST["username"]);
$password= mysqli_escape_string($connect,$_POST["password"]);
$error = "";
$success = "";

if(empty($username)){
$error = "Please Input Username";

}else if(empty($password)){
$error = "Please Input Password";

}else{
$query = mysqli_query($connect,"SELECT * FROM users WHERE username='$username'");

if(mysqli_num_rows($query) > 0){
$row = mysqli_fetch_assoc($query);
$id = $row["id"];
$dbPassword = $row["password"];

if(!password_verify($password,$dbPassword)){
$error = "Invalid password please try again";

}else{
$success = "Success Login....";
$_SESSION["id"] = $id;
//redirect to login page
header("Refresh:2;url=index.php");


}

}else{
$error = "User not Found";  
}
}
 

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>
</head>
<body>
    <form action="login.php" method="POST" class="form">
    <h1>LOGIN</h1>
    <?php
    if(!empty($error)){
    echo "<span class='error'>$error</span>";
    }
    if(!empty($success)){
    echo "<span class='success'>$success</span>";
    }
    
    
    ?>

 
    <input type="text" name="username" placeholder="Username" class="input">
    <input type="password" name="password" placeholder="Password" class="input">
    <input type="submit" name="submit" value="Login" class="btn">
    <a href="reg.php">Create An Account</a>
    </form>
</body>
</html>