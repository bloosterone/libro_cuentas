<?php

  include('database.php');

 $task_sumaresta = $_POST['positivo_negativo'];
  echo $task_sumaresta;
  

if(isset($_POST['titulo'])) {
  # echo $_POST['name'] . ', ' . $_POST['description'];
  $task_titulo = $_POST['titulo'];
  $task_date = $_POST['date'];
  $task_pago = $_POST['pago'];
  $task_dinero_tarjeta = $_POST['dinero_tarjeta'];
  
  $task_dinero_efectivo = $_POST['dinero_efectivo'];
   
  $task_dinero_deben = $_POST['dinero_deben'];

  $task_description = $_POST['description'];
   $task_pagado = $_POST['pagado'];
   echo $task_pagado;
   $task_salida = $_POST['salida'];
   $task_ingreso=$_POST['ingreso'];

 
 

  $query = "INSERT into tareas(titulo, fecha, m_pago, dinero_tarjeta, dinero_efectivo, dinero_deben, comentario, ingreso,salida,pagado) VALUES ('$task_titulo', '$task_date','$task_pago','$task_dinero_tarjeta','$task_dinero_efectivo','$task_dinero_deben','$task_description','$task_ingreso','$task_salida','$task_pagado')";

  $result = mysqli_query($connection, $query);

  if (!$result) {
    die('Ingreso fallido');
  }

  echo "Ingreso realizado correctamente";  

}
if(isset($_POST['capital'])) {


   echo "Hay capital";
   $task_capital = $_POST['capital'];
  $task_tarjeta = $_POST['tarjeta'];
  $task_efectivo = $_POST['efectivo'];
  $task_supuesto = $_POST['supuesto'];
echo $task_supuesto;
if ($task_sumaresta<=1) {

 $total_tarjeta = $task_tarjeta+$task_dinero_tarjeta;
$total_efectivo = $task_efectivo+$task_dinero_efectivo;
$task_capital = $total_tarjeta+$total_efectivo;
$total_supuesto = $task_supuesto+$task_dinero_deben;


  $query2 = "UPDATE valores SET capital = '$task_capital', tarjeta = '$total_tarjeta', efectivo = '$total_efectivo', supuesto = '$total_supuesto' WHERE id = '1'";

  
  $result2 = mysqli_query($connection, $query2);

  if (!$result2) {
    die('Valores fallidos');
  }

  echo "Valores agregados correctamente";  
}
else if ($task_sumaresta>=2) {
  # code...


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
else{
  echo "error no conocido";
}


}
else
echo "no llega el capital";

?>
