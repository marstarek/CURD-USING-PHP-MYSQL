<html>

<head>
     <meta charset="utf-8" />
     <meta http-equiv="X-UA-Compatible" content="IE=edge" />
     <title></title>
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
<?php
	//check for errors
	$errors_arr = array();
	if(isset($_GET['error_feilds'])){
		$errors_arr = explode(",",$_GET['error_feilds']);
	}


	?>

<body>
     <div class="container py-5">
          <div class="row mx-auto">
               <div class="col-md-6 mx-auto">
                    <h1 class="text-center mx-auto mb-4">Registr</h1>

                    <form action="process.php" method="POST" class="text-center">
                         <div class="row mb-3">
                              <!-- <label for="name" class="col-sm-2 col-form-label">Name</label> -->
                              <div class="col-sm-12">
                                   <input type="text" class="form-control" name="name" id="name"
                                        placeholder="enter your name" />
                                   <?php 
		if(in_array("name", $errors_arr))
			echo "* Please enter your name ";
		?>
                              </div>
                         </div>
                         <div class="row mb-3">
                              <!-- <label for="email" class="col-sm-2 col-form-label">Email</label> -->
                              <div class="col-sm-12">
                                   <input type="email" class="form-control" name="email" id="email"
                                        placeholder="enter your email" />
                                   <?php 
		if(in_array("email", $errors_arr))
			echo "* Please enter your email ";
		?>
                              </div>
                         </div>
                         <div class="row mb-3">
                              <!-- <label for="password" class="col-sm-2 col-form-label">Password</label> -->
                              <div class="col-sm-12">
                                   <input class="form-control" type="password" name="password" id="password"
                                        placeholder="enter your password" />
                                   <?php 
		if(in_array("password", $errors_arr))
			echo "* Please enter your password ";
		?>
                              </div>
                         </div>
                         <fieldset class="row mb-3">
                              <legend class="col-form-label col-sm-12 pt-0 fs-3" for="gender">gender</legend>
                              <div class="col-sm-6 mx-auto">
                                   <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gender" id="male"
                                             value="male" checked />
                                        <label class="form-check-label fs-5" for="male"> male </label>
                                   </div>
                                   <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gender" id="female"
                                             value="female" />
                                        <label class="form-check-label fs-5" for="female"> female </label>
                                   </div>

                              </div>
                         </fieldset>
                         <!--  -->

                         <button class="btn btn-primary px-3" type="submit" name="submit" value="Register">sign
                              up</button>


                    </form>
               </div>
          </div>
     </div>



</body>


</html>