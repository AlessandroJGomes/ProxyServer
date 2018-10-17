<?php
  /**
   * @author Alessandro Gomes
   * @version 09.10.2018
   * Questa classe gestisce la scrittura e la visualizzazione dei link che si vogliono inserire nella White-List.
   */
  class linkGestions
  {
    private $path = null;
    private $file = null;
    private $list = null;


    function __construct()
    {
    }

    function getData(){
      $path = "../CSV/link.csv";
      $file = fopen($path,"r");
      $list = array();
      $a = 0;
      for ($i = 0; $i < count($file) ; $i++) {
        array_push($list, $i);

      }
      return $list;
      fclose($file);
    }

    function setData($link){
      $file = fopen($path, "w");
      $list = array_push($link);
      foreach ($list as $line)
      {
        fputcsv($file,explode(',',$line));
      }
      fclose($file);
    }


  }
/**
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
