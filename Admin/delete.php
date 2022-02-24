<?php
$conn = mysqli_connect("localhost", "root", null, "blog");
if (!$conn) {
    echo mysqli_connect_error();
    exit;
}
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$query = "DELETE FROM `users` WHERE `users`.`id` = ".$id." LIMIT 1 ";
if (mysqli_query($conn, $query)) {
    header("Location:list.php");
} else {
    echo mysqli_error($conn);
}
mysqli_close($conn);
