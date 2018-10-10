<?php
  /**
   * @author Alessandro Gomes
   * @version 09.10.2018
   * Questa classe gestisce la connessione al database e le iterazioni con esso tramite delle query contenute in funzioni specifiche.
   * Queste funzioni verranno poi utilizzate tramite richiamo dai file che necessitano tali funzioni.
   */
  class connection
  {
    //Connessione al db mysql
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "informatica";
    private $port = 3306;

    // Creo la variabile connessione
    private $conn;

    function __construct()
    {
      // Creo la connessione
      $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname, $this->port);

      // Controllo la connessione
      if ($this->conn->connect_error) {
        die("Connection failed: " . $this->conn->connect_error);
      }
    }

    /**
    * Questa funzione si occupa della "selezione" degli utenti che non posseggono l'accesso ad Internet, tramite una query.
    * @param year L'anno della classe selezionata.
    * @param id L'identificativo della classe selezionata.
    */
    function getClassBlocked($year, $id){
      $stato = 0;
      $conn = self::__construct();
      //Query che permette l'estrapolazione degli utenti desiderati, utilizzando un prepare statement per evitare
      //delle SQLInjection.
      $stmt = $this->conn->prepare ("SELECT * FROM alunni where Anno_Classe = ? AND Id_Classe = ? AND Stato_Accesso = ?");
      $stmt->bind_param("isi", $year, $id, $stato);

      $containerData = array();
      //Eseguo la query.
      if($stmt->execute()){
        $result = $stmt->get_result();
        //Ciclo tutti i "dati" che la query mi ritorna e li inserisco in un'array.
        while ($row = $result->fetch_assoc()) {
          array_push($containerData, $row);
        }
        return $containerData;
      }else {
        echo "Non funziona";
      }
    }

    /**
    * Questa funzione si occupa della "selezione" degli utenti che posseggono l'accesso ad Internet, tramite una query.
    * @param year L'anno della classe selezionata.
    * @param id L'identificativo della classe selezionata.
    */
    function getClassSblocked($year, $id){
      $stato = 1;
      $conn = self::__construct();
      //Query che permette l'estrapolazione degli utenti desiderati, utilizzando un prepare statement per evitare
      //delle SQLInjection.
      $stmt = $this->conn->prepare ("SELECT * FROM alunni where Anno_Classe = ? AND Id_Classe = ? AND Stato_Accesso = ?");
      $stmt->bind_param("isi", $year, $id, $stato);

      $containerData = array();
      //Eseguo la query.
      if($stmt->execute()){
        $result = $stmt->get_result();
        //Ciclo tutti i "dati" che la query mi ritorna e li inserisco in un'array.
        while ($row = $result->fetch_assoc()) {
          array_push($containerData, $row);
        }
        return $containerData;
      }else {
        echo "NOn funziona";
      }
    }
  }
?>
