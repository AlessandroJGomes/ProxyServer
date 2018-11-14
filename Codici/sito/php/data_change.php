<?php

  require_once('db_connection.php');

  /**
  * @author Alessandro Gomes
  * @version 09.10.2018
  * Questa classe gestisce l'interazione della scelta degli allievi a cui sbloccare o bloccare internet o YouTube.
  * Queste funzioni verranno poi utilizzate tramite richiamo dai file che necessitano tali funzioni.
  */
  class gestions {
    /**
    * Metodo costruttore della classe linkGestions.
    */
    function __construct() {
    }

    /**
    * Questa funzione si occupa della gestione dei checkbox dello stato d'accesso selezionati da parte dell'amministratore.
    * @param state L'array contenente tutti i nomi ed i cognomi degli allievi selezionati.
    * @param year L'anno della classe selezionata.
    * @param id L'identificativo della classe selezionata.
    * @param currentState Lo stato attuale dell'utente (bloccato o sbloccato).
    * @param conn L'oggetto che gestisce la connessione al database.
    */
    function getCheckboxState($state, $year, $id, $start, $end, $currentState, $conn) {
      //Creazione variabili.
      $blockState = 0;
      $UnBlockState = 1;
      $resState = array();
      if ($start == "" && $end == "") {
        //Controllo se l'array contenente i nomi ed i cognomi degli alunni selezionati é vuoto oppure no.
        if(count($state) != 0) {
          //Ciclo l'array e divido il nome ed il cognome di ogni allievo in un'differente array.
          for ($i=0; $i < count($state); $i++) {
            $stateId = explode(".", $state[$i]);
            array_push($resState, $stateId);
            //Controllo lo stato d'accesso ad internet se é bloccato (0) o sbloccato (1).
            if($currentState == 0) {
              //Eseguo la query che modifica lo stato d'accesso.
              $stmt = $conn->conn->prepare("UPDATE alunni set Stato_Accesso = ? where Nome = ? && Cognome = ?");
              $stmt->bind_param("iss", $UnBlockState, $resState[$i][0],  $resState[$i][1]);
            }else {
              $stmt = $conn->conn->prepare("UPDATE alunni set Stato_Accesso = ? where Nome = ? && Cognome = ?");
              $stmt->bind_param("iss", $blockState, $resState[$i][0],  $resState[$i][1]);
            }
            if($stmt->execute()) {
              //Richiamo le funzioni che si occupano di stampare a schermo le due tabelle degli alunni bloccati e non.
              $conn->getClassBlocked($year, $id);
              $conn->getClassUnblocked($year, $id);
            }else {
              echo "Query non eseguita";
            }
          }
        }else {
          echo "Nessun'alunno selezionato";
        }
      }else {
        //Controllo se l'array contenente i nomi ed i cognomi degli alunni selezionati é vuoto oppure no.
        if(count($state) != 0) {
          //Ciclo l'array e divido il nome ed il cognome di ogni allievo in un'differente array.
          for ($i=0; $i < count($state); $i++) {
            $stateId = explode(".", $state[$i]);
            array_push($resState, $stateId);
            //Controllo lo stato d'accesso ad internet se é bloccato (0) o sbloccato (1).
            if($currentState == 0) {
              //Eseguo la query che modifica lo stato d'accesso.
              $stmt = $conn->conn->prepare("UPDATE alunni set Stato_Accesso = ? where Nome = ? && Cognome = ?");
              $stmt->bind_param("iss", $UnBlockState, $resState[$i][0],  $resState[$i][1]);
            }else {
              $stmt = $conn->conn->prepare("UPDATE alunni set Stato_Accesso = ? where Nome = ? && Cognome = ?");
              $stmt->bind_param("iss", $blockState, $resState[$i][0],  $resState[$i][1]);
            }
            if($stmt->execute()) {
              //Richiamo le funzioni che si occupano di stampare a schermo le due tabelle degli alunni bloccati e non.
              $conn->getClassBlocked($year, $id);
              $conn->getClassUnblocked($year, $id);
            }else {
              echo "Query non eseguita";
            }
          }
        }else {
          echo "Nessun'alunno selezionato";
        }
      }
    }

    /**
    * Questa funzione si occupa della gestione dei checkbox di YouTube selezionati da parte dell'amministratore.
    * @param youtube L'array contenente tutti i nomi ed i cognomi degli allievi selezionati.
    * @param year L'anno della classe selezionata.
    * @param id L'identificativo della classe selezionata.
    * @param currentState Lo stato attuale dell'utente (bloccato o sbloccato).
    * @param conn L'oggetto che gestisce la connessione al database.
    */
    function getCheckboxYouTube($youtube, $year, $id, $start, $end, $currentState, $conn) {
      //Creazione variabili.
      $blockState = 0;
      $UnBlockState = 1;
      $resYouTube = array();
      if ($start == "" && $end == "") {
        //Controllo se l'array contenente i nomi ed i cognomi degli alunni selezionati é vuoto oppure no.
        if(count($youtube) != 0) {
          //Ciclo l'array e divido il nome ed il cognome di ogni allievo in un'differente array.
          for ($i=0; $i < count($youtube); $i++) {
            $youtubeId = explode(".", $youtube[$i]);
            array_push($resYouTube, $youtubeId);

            //$youtubeState = $conn->conn->prepare ("SELECT Youtube FROM alunni where Anno_Classe = ? && Id_Classe = ? && Nome = ? && Cognome = ?");
            //$youtubeState->bind_param("isss", $year, $id, $resYouTube[$i][0],  $resYouTube[$i][1]);

            //Controllo lo stato d'accesso di YouTubet se é bloccato (0) o sbloccato (1).
            if($currentState == 0) {
              //Eseguo la query che modifica lo stato d'accesso per YouTube.
              $stmt = $conn->conn->prepare("UPDATE alunni set Youtube = ? where Nome = ? && Cognome = ?");
              $stmt->bind_param("iss", $UnBlockState, $resYouTube[$i][0],  $resYouTube[$i][1]);
            }else {
              $stmt = $conn->conn->prepare("UPDATE alunni set Youtube = ? where Nome = ? && Cognome = ?");
              $stmt->bind_param("iss", $blockState, $resYouTube[$i][0],  $resYouTube[$i][1]);
            }
            if($stmt->execute()) {
              //Richiamo le funzioni che si occupano di stampare a schermo le due tabelle degli alunni bloccati e non.
              $conn->getClassBlocked($year, $id);
              $conn->getClassUnblocked($year, $id);
            }else {
              echo "Query non eseguita";
            }
          }
        }else {
          echo "Nessun'alunno selezionato";
        }
      }else {

      }
    }
  }
?>
