<?php

  class Provinsi{
    public $id_prov;
    public $nama;
    public $table_name = "provinsi";

    function __construct($dbh){
      $this->dbh = $dbh;
    }

    function select($column = 1, $value = 1){
      switch($column) {
          case 'id_prov':
              $col[] = 'id_prov = ?';
              break;
          case 'nama':
              $col[] = 'nama = ?';
              break;
          case 1:
              $col[] = '1 = ?';
              break;
      }
      $sql = "SELECT * FROM $this->table_name";
      // $end = "ORDER BY LPAD(LOWER(nama), 10,0) ASC";
      $sql .= " WHERE ".implode(" AND ", $col);
      $stmt = $this->dbh->prepare($sql);
      $stmt->execute([$value]);
      // print_r($stmt);
      return $stmt;
    }

    function insert(){
      $data = $this->select();
      $lastId = 0;

      if (empty($data)) {
          $lastId = 0;
      } else {
          foreach ($data as $value) {
            $lastId = $value["id_prov"];
          }
      }

      $lastId += 1;
      $newId = $lastId;
      //echo $newId;

      $sql = "INSERT INTO $this->table_name (id_prov, nama) VALUES (?, ?)";

      $this->nama = htmlspecialchars(strip_tags($this->nama));

      if($this->dbh->prepare($sql)->execute([$newId, $this->nama])){
        return true;
      };
      return false;
    }

    function update(){
      $sql = "UPDATE $this->table_name SET nama = ? WHERE id_prov = ?";

      $this->nama = htmlspecialchars(strip_tags($this->nama));
      $this->id_prov = htmlspecialchars(strip_tags($this->id_prov));

      if($this->dbh->prepare($sql)->execute([$this->nama, $this->id_prov])){
        return true;
      }
      return false;
    }

    function delete(){
      $sql = "DELETE FROM $this->table_name WHERE id_prov = ?";

      $this->id_prov = htmlspecialchars(strip_tags($this->id_prov));

      if($this->dbh->prepare($sql)->execute([$this->id_prov])){
        return true;
      }
      return false;
    }
  }

?>
