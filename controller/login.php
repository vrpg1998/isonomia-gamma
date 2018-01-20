<?php

/**
 *
 * Clase para el inicio de sesión
 *
 */
class LoginController
{
  private $model;

  function _construct()
  {
    include_once '../model/login.php';
    $model = new LoginModel();
  }

  public function load()
  {
    include_once "view/login.html";
  }

  private function validateData()
  {
    $result = $model->check()
  }
}


 ?>
