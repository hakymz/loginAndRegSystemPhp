<?php 
require_once "header.php";
 if(isset($_POST["submit"]) && $_SERVER["REQUEST_METHOD"] == "POST"){
    $username = mysqli_escape_string($connect,$_POST["username"]);
    $email = mysqli_escape_string($connect,$_POST["email"]);
    $password= mysqli_escape_string($connect,$_POST["password"]);
    $error = "";
    $success = "";
 
 if(empty($username)){
 $error = "Please Input Username";

 }else if(empty($email)){
 $error = "Please Input Email";

 }else if(filter_var($email,FILTER_VALIDATE_EMAIL) == false){
 $error = "Please Input Valid Email";

 }else if(empty($password)){
 $error = "Please Input Password";

 }else{
$query = mysqli_query($connect,"SELECT * FROM users WHERE username='$username'");
if(mysqli_num_rows($query) > 0){
$error = "Username already exist please try again";

}else{
$query = mysqli_query($connect,"SELECT * FROM users WHERE email='$email'"); 
if(mysqli_num_rows($query) > 0){
$error = "Email already exist please try again";

}else{
$passwordHash = password_hash($password,PASSWORD_DEFAULT); 
mysqli_query($connect,"INSERT INTO users(username,email,password)VALUE('$username','$email','$passwordHash')");
$success = "Registration Was Successful please login..."; 

}  
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
    <form  class="form" action="reg.php" method="POST">
    <h1>REGISTER</h1>
    <?php
    if(!empty($error)){
    echo "<div class='error'>$error</div>";
    }
    if(!empty($success)){
    echo "<div class='success'>$success</div>";
    }
    
    ?>
    <input type="text" name="username" placeholder="Username" class="input">
    <input type="text" name="email"  placeholder="Email" class="input">
    <input type="password" name="password"  placeholder="Password" class="input">
    <input type="submit" name="submit" value="Register" class="btn">
    <a href="login.php">Login To Your Account</a>
    </form>
</body>
</html>