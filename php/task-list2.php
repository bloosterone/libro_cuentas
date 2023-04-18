<?php

  include('database.php');

  $query = "SELECT * from tareas";
  $result = mysqli_query($connection, $query);
  if(!$result) {
    die('Query Failed'. mysqli_error($connection));
  }

  $json = array();
  while($row = mysqli_fetch_array($result)) {
    $json[] = array(
      'titulo' => $row['titulo'],
      'date' => $row['fecha'],
      'pago' => $row['m_pago'],
     'dinero_tarjeta' => $row['dinero_tarjeta'],
      'dinero_efectivo' => $row['dinero_efectivo'],
      'description' => $row['comentario'],
      'id' => $row['id']
    );
  }
  $jsonstring = json_encode($json);
  echo $jsonstring;
?>