<?php
  /**
   * @author Alessandro Gomes
   * @version 09.10.2018
   * Questa classe gestisce la scrittura e la visualizzazione dei link che si vogliono inserire nella White-List.
   */
  class linkGestions
  {
    private $checkLink = array();


    function __construct()
    {

    }

    function getData(){

      $getList = array();
      $path = "../CSV/link.csv";
      $file = fopen($path,"r");
      while ($data = fgetcsv($file)) {

        array_push($getList, $data);

      }
      $checkLink = $getList;
      return $getList;
      fclose($file);
    }


    function setData($link) {

      $setList = array();
      $path = "../CSV/link.csv";
      $file = fopen($path, "a");
      array_push($setList, $link);

      //print_r($setList);
      foreach ($setList as $line)
      {
        //var_dump($setList);
        print_r(in_array($link, $this->getData()));
        fputcsv($file, $setList);
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
