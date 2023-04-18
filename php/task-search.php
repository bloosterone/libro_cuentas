<?php

include('database.php');

$search = $_POST['search'];
if(!empty($search)) {
  $query = "SELECT * FROM tareas WHERE titulo LIKE '$search%'";
  $result = mysqli_query($connection, $query);
  
  if(!$result) {
    die('Query Error' . mysqli_error($connection));
  }
  
  $json = array();
  while($row = mysqli_fetch_array($result)) {
    $json[] = array(
      'titulo' => $row['titulo'],
      'date' => $row['fecha'],
      'pago' => $row['m_pago'],
      'dinero_tarjeta' => $row['dinero_tarjeta'],
      'dinero_efectivo' => $row['dinero_efectivo'],
      'dinero_deben' => $row['dinero_deben'],
      'description' => $row['comentario'],
      'id' => $row['id']
    );
  }
  $jsonstring = json_encode($json);
  echo $jsonstring;
}

?>
