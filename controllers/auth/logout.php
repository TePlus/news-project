<?php

// if(!isset($_SESSION['user'])){
//     header("Location: " . WEB_META_BASE_URL . "auth");
// }
session_destroy();

header("Location: " . WEB_META_BASE_URL . "auth");


//  if (!isset($_SESSION['user'])) {
//   header("Location: " + WEB_META_BASE_URL + "auth");
//  } else if(isset($_SESSION['user'])!="") {
//   header("Location: home.php");
//  }
 
//  if (isset($_GET['logout'])) {
//   unset($_SESSION['user']);
//   session_unset();
// //   session_destroy();
//   header("Location: index.php");
//   exit;
//  }

session_destroy();
header("Location: auth");

 ?>