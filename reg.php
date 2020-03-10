
<?php
require_once "header.php";


if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])){
$username = mysqli_escape_string($connect,$_POST["username"]);
$email = mysqli_escape_string($connect,$_POST["email"]);
$password = mysqli_escape_string($connect,$_POST["password"]);
$error = "";
$success = "";

if(empty($username)){
$error = "Please Input Username";

}else if(empty($email)){
$error = "Please Input Email";   

}else if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
$error = "Please Input a valid Email";

}else if(empty($password)){
$error = "Please Input Password";

}else{
$query = mysqli_query($connect,"SELECT * FROM users WHERE username='$username'");
if(mysqli_num_rows($query) > 0){
$error = "Username Already Exist Please Try Again";

}else {
$query = mysqli_query($connect,"SELECT * FROM users WHERE email='$email'");
if(mysqli_num_rows($query) > 0){
$error = "Email Already Exist Please Try Again";

}else {
//hash password
$passwordHash = password_hash($password,PASSWORD_DEFAULT);
mysqli_query($connect,"INSERT INTO users (username,email,password) VALUES ('$username','$email','$passwordHash')");
$success = "Registration was successful please login..";

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
    <form action="reg.php" method="POST" class="form">
    <h1>REGISTER</h1>
    <?php if(!empty($error)){
        echo"<div class='error'>$error</div>";
        }

        if(!empty($success)){
            echo"<div class='success'>$success</div>";
            }
            
        
        ?>
    <input type="text" name="username" placeholder="Username" class="input">
    <input type="text" name="email" placeholder="Email" class="input">
    <input type="password" name="password" placeholder="Password" class="input">
    <input type="submit" name="submit" value="Register" class="btn">
    <a href="login.php">Login To Your Account</a>
    </form>
</body>
</html>