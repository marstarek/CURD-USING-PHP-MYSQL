<?php
$error_feilds = array();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
// Validation

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
        // header('Location: form.php?error_feilds='.implode(",", $error_feilds));

        $conn = mysqli_connect("localhost", "root", null, "blog");

        if (!$conn) {
            echo mysqli_connect_error();
            exit;
        }

        $name = mysqli_escape_string($conn, $_POST['name']);
        $email = mysqli_escape_string($conn, $_POST['email']);
        $password = sha1($_POST['password']);
        $admin = (isset($_POST['admin'])) ? 1 : 0;
        $uploads_dir=$_SERVER['DOCUMENT_ROOT'].'uploads';
$avatar='';
if($_FILES ['avatar']['error']==UPLOAD_ERR_OK){
    $temp_name=$_FILES['avatar']['temp_name'];
    $avatar=basename($_FILES['avatar']['name']);
    move_uploaded_file($temp_name,'$uploads_dir/$name.$avatar');
}else{
    echo "error cant upload file";
    exit;
}
        $query = "INSERT INTO `users` (`name`,`email`,`password`,`admin`) VALUES ('" . $name . "' , '" . $email . "','" . $password . "','" . $admin . "')";
        if (mysqli_query($conn, $query)) {
            header("Location: list.php");
        } else {
            //echo $query;
            echo mysqli_error($conn);
        }

        mysqli_close($conn);
    }
}
?>

<html>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<title>ADD</title>
<meta name="description" content="" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
     integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" />
<link rel="preconnect" href="https://fonts.googleapis.com" />
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
<link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;500;700&family=Indie+Flower&family=Pacifico&family=Patrick+Hand&family=Pushster&display=swap"
     rel="stylesheet" />
<link rel="preconnect" href="https://fonts.googleapis.com" />
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500;600;700;800&family=Dancing+Script:wght@400;500;700&family=Indie+Flower&family=Pacifico&family=Patrick+Hand&family=Pushster&display=swap"
     rel="stylesheet" />
<link rel="stylesheet" href="../<meta charset=" utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<title>Login</title>
<meta name="description" content="" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
     integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" />
<link rel="preconnect" href="https://fonts.googleapis.com" />
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
<link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;500;700&family=Indie+Flower&family=Pacifico&family=Patrick+Hand&family=Pushster&display=swap"
     rel="stylesheet" />
<link rel="preconnect" href="https://fonts.googleapis.com" />
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500;600;700;800&family=Dancing+Script:wght@400;500;700&family=Indie+Flower&family=Pacifico&family=Patrick+Hand&family=Pushster&display=swap"
     rel="stylesheet" />
<link rel="stylesheet" href="../css/style.css" />

<body>
     <div class="container">

          <div class="row mx-auto py-5">

               <div class="col-md-6 mx-auto ">
                    <form method="POST" enctype="multipart/form-data">
                         <h1 class="text-center mx-auto mb-4">Add User</h1>
                         <div class="col-sm-12 mb-3">
                              <input type="name" class="form-control" name="name" id="name"
                                   placeholder="enter your name"
                                   value="<?=isset($_POST['name']) ? $_POST['name'] : ''?>" />
                              <?php 
if (in_array("name", $error_feilds)) {
    echo "* Please enter your name ";
}
?>
                         </div>
                         <div class="col-sm-12 mb-3">
                              <input type="email" class="form-control" name="email" id="email"
                                   placeholder="enter your email"
                                   value="<?=isset($_POST['email']) ? $_POST['email'] : ''?>" />
                              <?php
if (in_array("email", $error_feilds)) {
    echo "* Please enter your email ";
}
?>
                         </div>
                         <div class="col-sm-12 mb-3">
                              <input type="password" class="form-control" name="password" id="password"
                                   placeholder="enter your password" />
                              <?php
if (in_array("password", $error_feilds)) {
    echo "* password at least 6 characters ! ";
}
?>
                         </div>
                         <br>
                         <!--  -->
                         <fieldset class="row mb-3">
                              <legend class="col-form-label col-sm-12 pt-0 fs-5 text-left" for="Admin">Are you an
                                   Admin?</legend>

                              <div class="col-sm-6 mx-auto text-center">
                                   <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="Admin" id="Admin"
                                             value="Admin" checked />
                                        <label class="form-check-label fs-5" for="Admin"> Admin </label>
                                   </div>

                              </div>
                              <div class="col-sm-6 mx-auto text-center">
                                   <legend class=" pt-0 fs-5 " for="Admin">choose your Avatar</legend>
                                   <input type="file" class="btn" id="avatar" name="avatar">
                              </div>
                         </fieldset>
                         <div class="text-center">
                              <button class="btn btn-primary px-3 mx-auto text-center " type="submit" name="submit"
                                   value="Add">
                                   Add</button>
                         </div>


                    </form>

               </div>
          </div>
     </div>


</body>

</html>