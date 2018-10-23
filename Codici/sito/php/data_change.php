<?php
  require_once('db_connection.php');

  /**
   *
   */
  class gestions
  {

    function __construct()
    {
      $conn = new connection();
    }
    function getCheckboxState($state){
      $resState = array();

      if(count($state) != 0){
        for ($i=0; $i < count($state); $i++) {
          $stateId = explode("_", $state[$i]);
          array_push($resState, $stateId);

        }
      }else{
        echo "Non funziona";
      }
      echo "<pre>";
      echo "Stato";
      print_r($resState);
      echo "</pre>";
    }

    function getCheckboxYouTube($youtube){
      $resYouTube = array();

      if(count($youtube) != 0){
        for ($i=0; $i < count($youtube); $i++) {
          $youtubeId = explode("_", $youtube[$i]);
          array_push($resYouTube, $youtubeId);

        }
      }else{
        echo "Non funziona";
      }
      echo "<pre>";
      echo "YouTube";
      print_r($resYouTube);
      echo "</pre>";
    }
}





  /*echo "<table>";
  echo "<tr>";
  echo "<th>Nome</th>";
  echo "<th>Cognome</th>";
  echo "<th>Stato</th>";
  echo "<th>YouTube</th>";
  echo "<th>Anno</th>";
  echo "<th>Id</th>";
  echo "</tr>";
  while($stmt->fetch()) {
    echo "<tr>";
    echo "<td>$nome</td>";
    echo "<td>$cognome</td>";
    echo "<td>$anni</td>";
    echo "<td>$genere</td>";
    echo "</tr>";
  }
  echo "</table><br>";*/

 ?>
