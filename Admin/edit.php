<?php
$error_feilds = array();
$conn = mysqli_connect("localhost", "root", null, "blog");
if (!$conn) {
    echo mysqli_connect_error();
    exit;
}
//edit.php ?id=1  == $_GET['id']
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$select = "SELECT * FROM users WHERE users.id=" . $id . " LIMIT 1 ";
//$select = "SELECT * FROM `users` WHERE `users`.`id` = " . $id . " LIMIT 1 ";
$result = mysqli_query($conn, $select);
$row = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!(isset($_POST['name']) && !empty($_POST['name']))) {
        $error_feilds[] = "name";
    }
    if (!(isset($_POST['email']) && filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL))) {
        $error_feilds[] = "email";
    }
    if (!(isset($_POST['password']) && strlen($_POST['password']) > 5)) {
        $error_feilds[] = "password";
    }

    if (!$error_feilds) {
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        $name = mysqli_escape_string($conn, $_POST['name']);
        $email = mysqli_escape_string($conn, $_POST['email']);
        $password = (!empty($_POST['password'])) ? sha1($_POST['password']) : $row['password'];
        $admin = (isset($_POST['admin'])) ? 1 : 0;
        $query = "UPDATE `users` SET `name`='" . $name . "',`email` ='" . $email . "',`password`='" . $password . "',`admin`= '" . $admin . "' WHERE `users`.`id` = " . $id;

        if (mysqli_query($conn, $query)) {
            header("Location:list.php");
            exit;
        } else {
            echo mysqli_error($conn);
        }
        mysqli_close($conn);
    }
}?>

<html>

<body>
     <form method="POST">
          <label for="name">Name</label>
          <input type="text" name="name" id="name" value="<?=isset($row['name']) ? $row['name'] : ''?>"><br>
          <?php
if (in_array("name", $error_feilds)) {
    echo "* Please enter your name ";
}

?>
          <br>
          <input type="hidden" name="id" id="id" value="<?=isset($row['id']) ? $row['id'] : ''?>">
          <label for="email">Email</label>
          <input type="email" name="email" id="email" value="<?=isset($row['email']) ? $row['email'] : ''?>"><br>
          <?php
if (in_array("email", $error_feilds)) {
    echo "* Please enter your email ";
}

?>
          <br>
          <label for="password">Password</label>
          <input type="password" name="password" id="password"><br><?php
if (in_array("password", $error_feilds)) {
    echo "* password at least 6 characters ! ";
}

?>
          <br>
          <label for="admin">Admin</label><br>
          <input type="checkbox" name="admin" <?=($row['admin']) ? 'checked' : ''?>>Admin
          <br>
          <input type="submit" name="submit" value="edite">


     </form>


</body>


</html>