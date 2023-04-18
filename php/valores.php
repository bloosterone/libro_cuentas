<?php
  header( "Access-Control-Allow-Origin: *" );
  include('database.php');

  $query = "SELECT * from valores";
  $result = mysqli_query($connection, $query);
  if(!$result) {
    die('Query Failed'. mysqli_error($connection));
  }

  $json = array();
  while($row = mysqli_fetch_array($result)) {
    $json[] = array(
      'capital' => $row['capital'],
      'tarjeta' => $row['tarjeta'],
      'efectivo' => $row['efectivo'],
      'supuesto' => $row['supuesto'],
            'id' => $row['id']
    );
  }
  $jsonstring = json_encode($json);
  
  echo $jsonstring;
?>