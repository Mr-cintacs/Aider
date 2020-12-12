<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="<?php echo URLROOT?>public/css/style.css ">
  <title><?php echo SITENAME; ?></title>
</head>
<body>
  <div>
    <h1> <?php echo SITENAME; ?> </h1>
    <ul>
      <li><a href="<?php echo URLROOT?>">Home</a></li>
      <li><a href="<?php echo URLROOT."/pages/about"?>">About</a></li>
      <?php if(isset($_SESSION['id'])): ?>
      <li>Welcome <?php echo $_SESSION['name'] ?> </li>
      <li><a href="<?php echo URLROOT."/users/logout" ;?>">Logout</a></li>
      <?php else:?>
      <li><a href="<?php echo URLROOT."/users/register"?>">Register</a></li>
      <li><a href="<?php echo URLROOT."/users/login"?>">Login</a></li>  
      <?php endif;?>
    </ul>
  </div>
