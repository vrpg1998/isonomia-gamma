<?php
require_once "controller/all.php";

if(isset($_SESSION['user'])) {
  $dashboard = new DashboardController();
  $dashboard->load();
} else {
  $login = new LoginController();
  $login->load();
}

 ?>
