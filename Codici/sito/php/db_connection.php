<?php
  /**
   *
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

    function getClassBlocked($year, $id){
      $stato = 0;
      $conn = self::__construct();
      $stmt = $this->conn->prepare ("SELECT * FROM alunni where Anno_Classe = ? AND Id_Classe = ? AND Stato_Accesso = ?");
      $stmt->bind_param("isi", $year, $id, $stato);

      $containerData = array();

      if($stmt->execute()){
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
          array_push($containerData, $row);
        }
        return $containerData;
      }else {
        echo "Non funziona";
      }
    }

    function getClassSblocked($year, $id){
      $stato = 1;
      $conn = self::__construct();
      $stmt = $this->conn->prepare ("SELECT * FROM alunni where Anno_Classe = ? AND Id_Classe = ? AND Stato_Accesso = ?");
      $stmt->bind_param("isi", $year, $id, $stato);

      $containerData = array();

      if($stmt->execute()){
        $result = $stmt->get_result();
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
