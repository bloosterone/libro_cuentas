<?php

include('database.php');


if(isset($_POST['id'])) {
	$valor_deben = $_POST['valor_deben'];
  $id = $_POST['id'];
  $debe_tarjeta_efectivo = $_POST['debe_tarjeta_efectivo'];

//------Obtengo valor supuesto
  $query_select1 = "SELECT supuesto FROM `valores`"; 
  $result = mysqli_query($connection, $query_select1);


  if (!$result) {
    die('No se obtuvo el supuesto');
  }
  
 $json1 = array();
  while($row = mysqli_fetch_array($result)) {
   $respuesta_supuesto = $row[0];
    
  }
  //------Obtengo valor efectivo
  $query_select2 = "SELECT efectivo FROM `valores`"; 
  $result_select2 = mysqli_query($connection, $query_select2);


  if (!$result_select2) {
    die('No se obtuvo el efectivo');
  }
  
 $json2 = array();
  while($row = mysqli_fetch_array($result_select2)) {
   $respuesta_efectivo = $row[0];
    
  }
  //-----------Obtengo valor tarjeta
  $query_select3= "SELECT tarjeta FROM `valores`"; 
  $result_select3 = mysqli_query($connection, $query_select3);


  if (!$result_select3) {
    die('No se obtuvo la tarjeta');
  }
  
 $json3 = array();
  while($row = mysqli_fetch_array($result_select3)) {
   $respuesta_tarjeta = $row[0];
    
  }
  //--------obtengo valor capital

  $query_select1 = "SELECT capital FROM `valores`"; 
  $result = mysqli_query($connection, $query_select1);


  if (!$result) {
    die('No se obtuvo el supuesto');
  }
  
 $json1 = array();
  while($row = mysqli_fetch_array($result)) {
   $respuesta_capital = $row[0];
    
  }






  $calculo1 = $respuesta_supuesto-$valor_deben;
 	$calculo2 = $valor_deben + $respuesta_efectivo;
 	$calculo3 = $valor_deben + $respuesta_tarjeta;


  if($debe_tarjeta_efectivo==1){

		$query2 = "UPDATE `valores` SET `supuesto` = '$calculo1' WHERE `valores`.`id` = 1";
		$result2 = mysqli_query($connection, $query2);

		if (!$result2) {
    	die('supuesto no se pudo modificar');
  		}
  		else{
  			echo 'se modifico el supuesto';
		$query3 = "UPDATE `valores` SET `efectivo` = '$calculo2' WHERE `valores`.`id` = 1";
		$result3 = mysqli_query($connection, $query3);

  			if (!$result3) {
  				 die('No se pudo agregar a efectivo');
  			}
  			echo "Agregado a efectivo correctamente"; 

  			
  		
 //---------------------------------------------------------
  			$query43 = "UPDATE tareas SET `pagado`= 1, `m_pago` = 'efectivo' WHERE id = '$id'"; 
  			$result43 = mysqli_query($connection, $query43);

  			if (!$result43) {
   			 die('No se pudo eliminar, ni pasar a ingresos');
 			}
  			echo "Eliminado correctamente y pasado a Ingresos";  
  		}
  }
  else if($debe_tarjeta_efectivo==2){
  	$query4 = "UPDATE `valores` SET `supuesto` = '$calculo1' WHERE `valores`.`id` = 1";
		$result4 = mysqli_query($connection, $query4);

		if (!$result4) {
    	die('supuesto no se pudo modificar');
  		}
  		else{
  			echo 'se modifico el supuesto';
		$query5 = "UPDATE `valores` SET `tarjeta` = '$calculo3' WHERE `valores`.`id` = 1";
		$result5 = mysqli_query($connection, $query5);

  			if (!$result5) {
  				 die('No se pudo agregar a tarjeta');
  			}
  			echo "Agregado a tarjeta correctamente"; 


			
  			$query33 = $query43 = "UPDATE tareas SET `pagado`= 1, `m_pago` = 'tarjeta' WHERE id = '$id'"; 
  			$result33 = mysqli_query($connection, $query33);

  			if (!$result33) {
   			 die('No se pudo eliminar');
 			}
  			echo "Eliminado correctamente";  
  		}
  }
//----------------------------Obtengo valor de efectivo nuevo--------------------------------------
 				$query_select10 = "SELECT efectivo FROM `valores`"; 
			  $result_select10 = mysqli_query($connection, $query_select10);


			  if (!$result_select10) {
			    die('No se obtuvo el efectivo');
			  }
			  
			
			  while($row = mysqli_fetch_array($result_select10)) {
			   $respuesta_efectivo10 = $row[0];
			    
			  }
//------------------------------------------------------------------
//------------------------------Obtengo valor de tarjeta nuevo --------------------------------
  				$query_select11 = "SELECT tarjeta FROM `valores`"; 
			  $result_select11 = mysqli_query($connection, $query_select11);


			  if (!$result_select11) {
			    die('No se obtuvo el efectivo');
			  }
			  
			 
			  while($row = mysqli_fetch_array($result_select11)) {
			   $respuesta_tarjeta11 = $row[0];
			    
			  }
//------------------------------------------------------------------			  
  		$calculo5 = $respuesta_efectivo10+$respuesta_tarjeta11;
  			$query7 = "UPDATE `valores` SET `capital` = '$calculo5' WHERE `valores`.`id` = 1";
		$result7 = mysqli_query($connection, $query7);

  			if (!$result7) {
  				 die('No se pudo sumar el capital');
  			}
  			echo "Agregado a capital correctamente"; 
  

}
else{
	echo "no llega nada";
}


?>
