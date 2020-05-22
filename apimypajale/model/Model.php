<?php

  class Model{
    function __construct($opt, $gejala){
      $this->opt = $opt;
      $this->gejala = $gejala;
    }

    function baseModelOpt(){
      $model = array();
      foreach ($this->gejala as $value) {
        array_push($model, $value['id']);
      }
      return $model;
    }

    function modelOPT($baseModelOpt){
      $model = array();
      foreach($this->opt as $value){
        $temp = array();
        $temp['nama'] = $value['nama'];
        $temp['model'] = array();
        for($i = 0; $i < sizeof($baseModelOpt); $i++){
          array_push($temp['model'], 0);
        }
        $tempGejala = explode(",", $value['gejala']);
        foreach ($tempGejala as $value) {
          if(array_search($value, $baseModelOpt) || array_search($value, $baseModelOpt) == 0){
            $index = array_search($value, $baseModelOpt);
            $temp['model'][$index] = 1;
          }
        }
        array_push($model, $temp);
      }
      return $model;
    }

    function predict($userInput, $baseModelOpt, $modelOpt){
      $userModel = array();
      $result = array();
      $bobot = array();
      for($i = 0; $i < sizeof($baseModelOpt); $i++){
        array_push($userModel, 0);
      }

      foreach($userInput as $value) {
        if(array_search($value, $baseModelOpt) || array_search($value, $baseModelOpt) == 0){
          $index = array_search($value, $baseModelOpt);
          $userModel[$index] = 1;
        }
      }
      //print_r($userModel);
      foreach ($modelOpt as $model) {
        $count = 0;
        $temp = array();
        $bobotOpt = 0;
        for ($i=0; $i < sizeof($model['model']); $i++) {
          //echo $i." -> ".$model['model'][$i]." === ".$userModel[$i]."<br><br>";
          if($model['model'][$i] === 1){
            $bobotOpt += 1;
          }
          if ($model['model'][$i] === 1 && $userModel[$i] === 1) {
            $count += 1;
          }
        }
        $temp['nama'] = $model['nama'];
        $temp['bobot'] = $count;
        $temp['totalBobot'] = $bobotOpt;
        $temp['probabilitas'] = round(($temp['bobot']/$temp['totalBobot']),3);
        array_push($result, $temp);
        //print_r($temp);
      }
      //print_r($result);
      foreach ($result as $value) {
        array_push($bobot, $value['bobot']);
      }

      $bobot = array_sum($bobot);
      // echo $bobot;
      $result = array_filter($result, function($key) use($bobot){
        return $key['bobot'] !== 0;
      });

      $keys = array_column($result, 'probabilitas');
      //print_r($keys);
      array_multisort($keys, SORT_DESC, $result);
      //print_r($result);
      return $result;
    }
  }

?>
