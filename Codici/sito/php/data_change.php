<?php
  require_once('db_connection.php');

  /**
   *
   */
  class gestions
  {

    function __construct()
    {

    }
    function getCheckboxState($state, $year, $id, $conn){
      $resState = array();
      if(count($state) != 0){
        for ($i=0; $i < count($state); $i++) {
          $stateId = explode("_", $state[$i]);
          array_push($resState, $stateId);

          $conn->getClassBlocked($year, $id, $resState[$i][0], $resState[$i][1]);
          $conn->getClassUnblocked($year, $id, $resState[$i][0], $resState[$i][1]);
          /*
          echo "<br>";
          echo "nome = ";
          print_r($resState[$i][0]);
          echo "<br>";
          echo "cognome = ";
          print_r($resState[$i][1]);
          echo "<br>";
          */
        }
      }else{
        echo "Non funziona";
      }
      echo "<br>";
      echo "<pre>";
      echo "Stato";
      print_r($resState);
      echo "</pre>";

    }

    function getCheckboxYouTube($youtube, $year, $id, $conn){
      $resYouTube = array();
      if(count($youtube) != 0){
        for ($i=0; $i < count($youtube); $i++) {
          $youtubeId = explode("_", $youtube[$i]);
          array_push($resYouTube, $youtubeId);

          $conn->getClassBlocked($year, $id, $resYouTube[$i][0], $resYouTube[$i][1]);
          $conn->getClassUnblocked($year, $id, $resYouTube[$i][0], $resYouTube[$i][1]);
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
