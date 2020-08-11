<?php
  include "db.php";

  if(isset($_POST['name'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $repassword = $_POST['repassword'];
    $created_date = date("Y-m-d H:i:s");
    $from = $_POST['from'];
       

  $sql = mysqli_query($link, "SELECT * FROM admin WHERE email='$email'") or die(mysqli_error($link));
    if(mysqli_num_rows($sql) > 0) {
      echo "email has been registered";
      exit;
    }

  mysqli_query($link, "INSERT INTO admin (name, email, password, created_date) VALUES ('$name','$email','$password', '$created_date')") or die(mysqli_error($link));

  header("location: signin.php");
  }
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>Lost In JB-Signup</title>
   <!-- Custom styles for this template -->
   <link href="css/signin.css" rel="stylesheet">
  </head>
  <body class="text-center">
    <form class="form-signin" action="signup.php" method="POST">

    <input type="hidden" name="from" value="<?=$_SERVER['HTTP_REFERER']?>"/>
    
  <img class="mb-4" src="/docs/4.5/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
  <h1 class="h3 mb-3 font-weight-normal">Lost In JB</h1>
  <h1 class="h3 mb-3 font-weight-normal">Register Member</h1>

  <label for="name" class="sr-only">Name</label>
  <input type="text" id="name" class="form-control" placeholder="Name" required autofocus name="name">

  <label for="email" class="sr-only">Email address</label>
  <input type="email" id="email" class="form-control" placeholder="Email address" required autofocus name="email">

  <label for="password" class="sr-only">Password</label>
  <input type="password" id="password" class="form-control" placeholder="Password" required name="password">

  <label for="repassword" class="sr-only">Confirm Password</label>
  <input type="password" id="repassword" class="form-control" placeholder="Confirm Password" required name="repassword">
  
  <button class="btn btn-lg btn-primary btn-block" type="submit">Sign up</button>
  <p>Already a user? <a href="signin.php">Sign in</a> here</p>
  <p>Or <a href="index.php">View Homepage</a> here</p>
  <p class="mt-5 mb-3 text-muted">&copy; 2017-2020</p>
</form>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  </body>
</html>