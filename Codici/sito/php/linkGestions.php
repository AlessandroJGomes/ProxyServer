<?php
  /**
   * @author Alessandro Gomes
   * @version 30.10.2018
   * Questa classe gestisce la scrittura e la visualizzazione dei link che si vogliono inserire nella White-List.
   */
  class linkGestions {
    private $checklink = array();
    /**
    * Metodo costruttore della classe linkGestions.
    */
    function __construct() {
    }

    /**
    * Funzione che gestisce la lettura e la stampa a schermo dei siti presenti nel file CSV.
    * @return list Lista contenente i siti presenti nella White-List.
    */
    function getData() {
      $getList = array();
      //Preparo il file CSV da aprire in sola lettura.
      $path = "../CSV/link.csv";
      $file = fopen($path,"r");
      //Ciclo tutto il contenuto del file CSV all'interno dell'array che andrò a ritornare.
      while ($data = fgetcsv($file)) {
        array_push($getList, $data);
      }
      return $getList;
      $checklink = $getList;
      //Chiudo il file CSV.
      fclose($file);
    }

    /**
    * Funzione che gestisce la ricezione del nuovo sito da inserire nelle White.List e lo inserisce nel file CSV.
    * @param link Sito web che l'amministratore vuole aggiungere alla White-List.
    */
    function setData($link) {
      $setList = array();
      //Preparo il file CSV da aprire in sola scrittura.
      $path = "../CSV/link.csv";
      $file = fopen($path, "a");
      if (in_array($link, $this->getData())) {
        echo "GIA PRESENTE";
      }else {
        array_push($setList, $link);
        foreach ($setList as $line) {
          //var_dump($setList);
          printf(in_array($link, $this->getData()));
          fputcsv($file, $setList);
        }
      }
      fclose($file);
    }

  }


/*
  $path = "../CSV/link.csv";
  $list = array(
    "www.instagram.com, www.tio.ch, www.google.com, www.facebook.com",
  );

  $file2 = fopen($path, "w");
  foreach ($list as $line)
  {
  fputcsv($file2,explode(',',$line));
  }
  fclose($file2);

  $file2 = fopen($path, "r");
  print_r(fgetcsv($file2));*/
?>
