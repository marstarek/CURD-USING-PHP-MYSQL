<?php



// Validation

$error_feilds = array();


if(!(isset($_POST['name']) && !empty($_POST['name']))){
	$error_feilds[]="name";
}
if(!(isset($_POST['email']) && filter_input(INPUT_POST, 'email',FILTER_VALIDATE_EMAIL))){
	$error_feilds[]="email";
}
if(!(isset($_POST['password'])&& strlen($_POST['password'])>5)){
	$error_feilds[]="password";
}
if($error_feilds){
	header('Location: form.php?error_feilds='.implode(",", $error_feilds));
	exit;
}

$conn = mysqli_connect("localhost","root", null ,"blog");

if(! $conn){
	echo mysqli_connect_error();
	exit;
}

$name = mysqli_escape_string($conn,$_POST['name']);
$email = mysqli_escape_string($conn,$_POST['email']);
$password = mysqli_escape_string($conn,$_POST['password']);






$query = "INSERT INTO `users` (`name`,`email`,`password`) VALUES ('".$name."' , '".$email."','".$password."')";
if (mysqli_query($conn,$query)) {
	echo "Thank you , Your Information has been saved !";
}else{
	echo $query;
	echo mysqli_error($conn);
}

mysqli_close($conn);