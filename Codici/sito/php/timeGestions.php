<?php
/**
* @author Alessandro Gomes
* @version 13.11.2018
* Questa classe gestisce i due menu a tendina in cui l'amministratore può selezionare l'orario
* d'inizio e di fine in cui sbloccare l'accesso ad internet ai relativi studenti.
* Questa funzione verrà poi utilizzata tramite richiamo dai file che necessitano tale funzione.
*/
  class time {
    /**
    * Metodo costruttore della classe linkGestions.
    */
    function __construct() {
    }

    /**
    * Funzione che serve a riempire i menu a tendina contenenti gli orari di inizio e di fine sblocco.
    * @return list Ritorna una lista di option per la select.
    */
    function getTime() {
      //Creo la variabile che "fornirà" l'intervallo tra un'opzione e la soccessiva della select.
      $interval = "+1 minutes";
      $output = "";
      //Creo le variabili del tempo corrente e del tempo finale.
      $current = time();
      $end = strtotime("23:59");
      //Ciclo fino a raggiungere le 23:59.
      while( $current <= $end ) {
        //Creo la variabile che andrà a "riempire" nel modo corretto tutti i value delle option in base all'orario corrente.
        $time = date( 'H:i', $current );
        //Creo l'option della select contenente l'orario.
        $output .= "<option value=\"{$time}\">" . date( 'H:i', $current ) .'</option>';
        $current = strtotime( $interval, $current );
      }
      return $output;
    }
  }

?>
