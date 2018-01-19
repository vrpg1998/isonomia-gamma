<?php

/**
 * Clase para manejar las conexiones a la base de datos
 */
class DataBase
{
  private $link;

  function __construct()
  {
    $link = new PDO("mysql:host=localhost;dbname=isonomia", "root", "");
  }

  /**
  *
  * Función para hacer consultas a la base de datos en general.
  *
  * $query String Consulta a realizar.
  *
  */
  public function Query($query)
  {
    if(isset($query)) {
      $result = $link->query($query) or die (print_r($link->errorInfo()));
      return $result;
    }
    return NULL;
  }

  /**
  *
  * Función para seleccionar datos de una tabla de la base de datos
  *
  * $table String Nombre de la tabla a la que se le realizará la consulta.
  *
  * $column String Columna(s) de la(s) que se desea obtener los datos. Selecciona
  *   todas la columnas de no ser especificado.
  *
  * $condition String Condición de selección de datos, de no ser especificado no se
  *   incluirá en la consulta.
  *
  */
  public function Select($table, $column = "*", $condition)
  {
    if(isset($table)) {
      $query = "SELECT ".$column." FROM ".$table;
      if(isset($condition)) {
        $query .= " WHERE ".$condition;
      }

      $result = $link->query($query) or die (print_r($link->errorInfo()));
      if($result->rowCount() > 0) {
        return $result;
      } else {
        return false;
      }
    }
    return NULL;
  }

  /**
  *
  * Función para insertar valores en la base de datos.
  *
  * $table String Nombre de la tabla a la que se le van a insertar los datos.
  *
  * $data Array Datos a insertar en la tabla. El index debe ser el nombre de
  *   la tabla y el valor, de ser de tipo texto, debe estar en el formato
  *   correspondiente, es decir, con las comillas y caracteres adecuados.
  *
  */
  public function Insert($table, $data)
  {
    $aux = 0;
    if(isset($table) && isset($data)) {
      $query = "INSERT INTO {$table} (";
      $values = "VALUES (";

      // Agrega los nombres de las columnas y sus valores al query
      foreach ($data as $column => $value) {
        if($aux == 1) {
          $query .= ","
          $values .= ",";
        } else {
          $aux = 1;
        }

        $query .= $column;
        $values .= $value;
      }

      $values .= ")";
      $query .= ") {$values}";

      $result = $link->query($query) or die (print_r($link->errorInfo()));
      return $result;
    }
    return NULL;
  }

  /**
  *
  * Función para actualizar los valores de la base de datos.
  *
  * $table String Nombre de la tabla a la que se le modificarán los valores.
  *
  * $data Array Datos a insertar en la tabla. El index debe ser el nombre de
  *   la tabla y el valor, de ser de tipo texto, debe estar en el formato
  *   correspondiente, es decir, con las comillas y caracteres adecuados.
  *
  * $condition String Condición de selección de datos, de no ser especificado no se
  *   incluirá en la consulta.
  *
  */
  public function Update($table, $data, $condition)
  {
    $aux = 0;
    if(isset($table) && isset($data)) {
      $query = "UPDATE {$table} SET ";

      // Agrega los datos a actualizar al query
      foreach ($data as $column => $value) {
        if($aux == 1) {
          $query .= ",";
        } else {
          $aux = 1;
        }

        $query .= "{$column} = {$value}";
      }

      if(isset($condition)) {
        $query = " WHERE {$condition}";
      }

      $result = $link->query($query);
      return $result;
    } else {
      return NULL;
    }
  }

  public function Delete($table, $index)
  {
    if(isset($tabel) && isset($index)) {
      $query = "DELETE "
    } else {
      return NULL;
    }
  }
}


 ?>
