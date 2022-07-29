<?php
$error_fields=array();
if(!(isset($_POST['name']) && !empty($_POST['name']))){
 $error_fields[]="name";
}
if(!(isset($_POST['email']) && filter_input(INPUT_POST,'email', FILTER_VALIDATE_EMAIL))){
    $error_fields[]="email";
}
if(!(isset($_POST['password']) && strlen($_POST['password']) > 5)){
    $error_fields[]="password";
}
if($error_fields){
    header("Location: login.php?error_fields=".implode("," ,$error_fields));
    exit;
} 
$conn = mysqli_connect("localhost" , "root" , "" ,"books");
if(! $conn){
    echo mysqli_connect_error();
    exit;
}

//escape special char to avoid sql injection
$name=mysqli_escape_string($conn , $_POST['name']);
$email=mysqli_escape_string($conn , $_POST['email']);
$password=mysqli_escape_string($conn , $_POST['password']);
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

//insert data
$query="INSERT INTO `users` (`name`, `email` , `password`) VALUES ('".$name."' , '".$email."','".$hashed_password."')";
if(mysqli_query($conn , $query)){
    header("Location: login.php");
}
else{
    echo mysqli_error($conn);
}
//close connection
mysqli_close($conn);
?>
