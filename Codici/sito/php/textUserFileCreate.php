<?php
    require_once('db_connection.php');

    /**
     *
     */
    class create
    {

      function __construct()
      {

      }

      function createAndReloadAbilitati($conn){
        $containerData = array();
        //Preparo il file TXT da aprire in scrittura.
        $path = "../textFile/abilitati.txt";
        $file = fopen($path, "a");

        //Creo una query che mi estrapoli il nome.cognome della tabella abilitati.
        $stmt = $conn->conn->prepare("SELECT * FROM abilitati");
        //Eseguo la query.
        if($stmt->execute()){
          $result = $stmt->get_result();
          //Ciclo tutti i "dati" che la query mi ritorna e li inserisco in un'array.
          while ($row = $result->fetch_assoc()) {
            array_push($containerData, $row);
          }
          for ($i = 0; $i < count($containerData); $i++) {
            fwrite($file, "\n" . $containerData[$i]["Username"]);
          }
          //print_r($containerData);
        }else {
          echo "Non funziona";
        }
        //Chiudo il file CSV.
        //fclose($file);
      }

      function createAndReloadYouTube($conn){
        //Preparo il file TXT da aprire in scrittura.
        //$path = "../CSV-TXT/YouTube.txt";
        //$file = fopen($path,"a");

      }
    }

?>
