<?php
// session_start();
// if (isset($_SESSION['id'])) {
//     echo '<p> Welcome ' . $_SESSION['email'] . '<a href="../logout.php">Logout</a></p>';
// } else {
//     header("Location: ../login.php");
//     exit;
// }
$conn = mysqli_connect("localhost", "root", null, "blog");
if (!$conn) {
    echo mysqli_connect_error();
    exit;
}
$query = "SELECT *  FROM `users`";
if (isset($_GET['search'])) {
    $search = mysqli_escape_string($conn, $_GET['search']); 
    $query .= " WHERE users.name LIKE '%" . $search . "%' OR users.email LIKE '%" . $search . "%'";
}
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html>

<head>
     <meta charset="utf-8" />
     <meta http-equiv="X-UA-Compatible" content="IE=edge" />
     <title>Admin :: List Users</title>
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
</head>

<body>
     <div class="container py-5">
          <div class="row">
               <div class="col-md-6 mx-auto">
                    <h1 class="my-3 mx-auto text-center">List Users</h1>
                    <form method="GET">
                         <div class="input-group mb-3">
                              <button class="btn btn-outline-danger" type="submit" value="search"
                                   id="button-addon1">search</button>
                              <input type="text" name="search" class="form-control"
                                   placeholder="Enter {Name} or {Email} to search" aria-label="search"
                                   aria-describedby="button-addon1">
                         </div>

                    </form>
                    <table class="mx-auto">
                         <thead>
                              <tr>
                                   <th>Id</th>
                                   <th>Name</th>
                                   <th>Email</th>
                                   <th>Admin</th>
                                   <th>Actions</th>
                              </tr>
                         </thead>
                         <tbody>
                              <?php
while ($row = mysqli_fetch_assoc($result)) {
    ?>
                              <tr class="border-bottom">
                                   <td class="pb-2"><?=$row['id']?></td>
                                   <td class="pb-2"><?=$row['name']?></td>
                                   <td class="pb-2"><?=$row['email']?></td>
                                   <td class="px-3 mb-2"><?=($row['admin']) ? 'Yes' : 'No'?></td>
                                   <td><a href="edit.php?id=<?=$row['id']?>">Edit</a> | <a
                                             href="delete.php?id=<?=$row['id']?>">Delete</a></td>
                              </tr>

                              <?php
}
?>
                         </tbody>

                         <tfoot>
                              <tr>
                                   <td colspan="2" style="text-align: center;"><?=mysqli_num_rows($result)?> Users</td>
                                   <td colspan="3" style="text-align: center;"><a href="add.php">Add User</a></td>
                              </tr>
                         </tfoot>



                    </table>
               </div>
          </div>
     </div>


</body>

</html>
<?php

mysqli_free_result($result);
mysqli_close($conn);
?>