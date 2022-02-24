<?php 
session_start();

$conn = mysqli_connect("localhost", "root", null, "blog");
if (!$conn) {
    echo mysqli_connect_error();
    exit;
}
$email=empty($_POST['email']) ? "" : mysqli_escape_string($conn,$_POST['email']);
$password=empty($_POST['password'])?"":sha1($_POST['password']);
$query="SELECT * FROM `users`WHERE `email`='".$email."'and `password`='".$password."'   LIMIT 1";
$result=mysqli_query($conn,$query);
if($row = mysqli_fetch_assoc($result)){
     $_SESSION['id']=$row['id'];
     $_SESSION['email']=$row['email'];
     header("Location:./admin/list.php");
     exit;

}else{
     
     // $error='Invalid email or password';
}
mysqli_free_result($result);
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="utf-8" />
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
     <link rel="stylesheet" href="./css/style.css" />
</head>

<body>
     <?php if(isset($error))echo $error ?>
          <div class="container">

               <div class="row mx-auto">

                    <div class="col-md-6 mx-auto ">
                    <form  action="./admin/list.php" method="post" class="text-center">

                         <h1 class="text-center mx-auto mb-4">Login</h1>
                         <div class="col-sm-12">
                              <input type="email" class="form-control" name="email" id="email"
                                   placeholder="enter your Email"
                                   value="<?=(isset($_POST['email']))?$_POST['email']:''	?>" /> <br />

                         </div>
                         <div class="col-sm-12">
                              <input type="password" class="form-control" name="password" id="password"
                                   placeholder="enter your password"
                                   value="<?=(isset($_POST['password']))?$_POST['password']:''	?>" /> <br />

                         </div>
                         <button class="btn btn-primary px-3" type="submit" name="submit" value="login">
                              login</button>

                         </form>

                    </div>
               </div>
          </div>


</body>

</html>