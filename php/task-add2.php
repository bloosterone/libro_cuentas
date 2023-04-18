<?php

  include('database.php');


  

if(isset($_POST['titulo'])) {
  # echo $_POST['name'] . ', ' . $_POST['description'];
  $task_titulo = $_POST['titulo'];
  $task_date = $_POST['date'];
  $task_pago = $_POST['pago'];
  $task_dinero_tarjeta = $_POST['dinero_tarjeta'];
  
  $task_dinero_efectivo = $_POST['dinero_efectivo'];
   
 
  $task_description = $_POST['description'];
 


  $query = "INSERT into tareas(titulo, fecha, m_pago, dinero_tarjeta, dinero_efectivo, comentario) VALUES ('$task_titulo', '$task_date','$task_pago','$task_dinero_tarjeta','$task_dinero_efectivo','$task_description')";

  $result = mysqli_query($connection, $query);

  if (!$result) {
    die('Salida fallida');
  }

  echo "Salida realizada correctamente";  

}
if(isset($_POST['capital'])) {


   echo "Hay capital";
   $task_capital = $_POST['capital'];
  $task_tarjeta = $_POST['tarjeta'];
  $task_efectivo = $_POST['efectivo'];
  $task_supuesto = $_POST['supuesto'];

$total_tarjeta = $task_tarjeta-$task_dinero_tarjeta;
$total_efectivo =$task_efectivo-$task_dinero_efectivo;
$task_capital = $total_tarjeta+$total_efectivo;


  $query2 = "UPDATE valores SET capital = '$task_capital', tarjeta = '$total_tarjeta', efectivo = '$total_efectivo' WHERE id = '1'";

  
  $result2 = mysqli_query($connection, $query2);

  if (!$result2) {
    die('Valores sacados incorrectamente');
  }

  echo "Valores restados correctamente";  

}
else
echo "no llega la salida";

?>
