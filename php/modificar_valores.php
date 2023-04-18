<?php

include ('database.php');


if (isset($_POST['tarje'])||isset($_POST['efece'])) {
echo "llega tarjeta o efectivo";

	
	$tarjeta= $_POST['tarje'];
	$efectivo = $_POST['efece'];
	$supuesto= $_POST['supue'];

	$calc= $tarjeta+$efectivo;
	$query = "UPDATE valores SET capital='$calc', tarjeta = '$tarjeta', efectivo='$efectivo', supuesto='$supuesto' WHERE id = 1";
	$response = mysqli_query($connection, $query);

	if (!$response) {
		die("No se pudo modificar los valores totales");
	}

	echo "Valores modificados correctamente";

}
else{
	echo "no llega nada";
}


?>