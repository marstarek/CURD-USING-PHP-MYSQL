<?php

$conn = mysqli_connect("localhost","root", null ,"blog");

if(! $conn){
	echo mysqli_connect_error();
	exit;
}


$query = "SELECT *  FROM `users`";
$result = mysqli_query($conn , $query );
while($row = mysqli_fetch_assoc($result)){
	echo "Id: ".$row['id']." <br />";
	echo "Name: ".$row['name']." <br />";
	echo "Email: ".$row['email']." <br />";
	echo str_repeat('-', 50)."<br />";
}

mysqli_free_result($result);
mysqli_close($conn);