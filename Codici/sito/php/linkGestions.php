<?php
  /**
   * @author Alessandro Gomes
   * @version 09.10.2018
   * Questa classe gestisce la scrittura e la visualizzazione dei link che si vogliono inserire nella White-List.
   */
  class linkGestions
  {
    function __construct()
    {
    }

    function getData(){
      $path = "../CSV/link.csv";
      $file = fopen($path,"r");
      $getlist = array();
      for ($i = 0; $i < count($file) ; $i++) {
        array_push($getlist, fgetcsv($file));

      }
      return $getlist;
      fclose($file);
    }

    function setData($link){
      $path = "../CSV/link.csv";
      $file = fopen($path, "w");
      $setList = array();
      array_push($setList, $link);
      foreach ($setList as $line)
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
