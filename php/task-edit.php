<?php

  include('database.php');

if(isset($_POST['id'])) {
 $task_titulo = $_POST['titulo'];
  $task_date = $_POST['date'];
  $task_pago = $_POST['pago'];
  $task_dinero_tarjeta = $_POST['dinero_tarjeta'];
    $task_dinero_efectivo = $_POST['dinero_efectivo'];
  $task_dinero_deben = $_POST['dinero_deben'];
  $task_description = $_POST['description'];
  $id = $_POST['id'];
  $query = "UPDATE tareas SET titulo = '$task_titulo', fecha = '$task_date', m_pago = '$task_pago', dinero_tarjeta = '$task_dinero_tarjeta', dinero_efectivo = '$task_dinero_efectivo', dinero_deben = '$task_dinero_deben', comentario = '$task_description' WHERE id = '$id'";
  $result = mysqli_query($connection, $query);

  if (!$result) {
    die('Query Failed.');
  }
  echo "Task Update Successfully";  

}

?>
