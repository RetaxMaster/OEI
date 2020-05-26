<?php

if (!isset($_SESSION["usuario"])) {
  if (isset($_COOKIE["usuario"])) {
    $_SESSION["usuario"] = $_COOKIE["usuario"];
    $_SESSION["rol"] = $_COOKIE["rol"];
  }
}

 ?>
