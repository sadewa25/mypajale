<?php

  class KategoriOPT{
    public $id;
    public $nama;
    public $table_name = "kategori_opt";

    function __construct($dbh){
      $this->dbh = $dbh;
    }

    function select($column = 1, $value = 1){
      switch($column) {
          case 'id':
              $col[] = 'id = ?';
              break;
          case 'nama':
              $col[] = 'nama = ?';
              break;
          case 1:
              $col[] = '1 = ?';
              break;
      }
      $sql = "SELECT * FROM $this->table_name";
      $end = "ORDER BY LPAD(LOWER(id), 10,0) ASC";
      $sql .= " WHERE ".implode(" AND ", $col)." ".$end;
      $stmt = $this->dbh->prepare($sql);
      $stmt->execute([$value]);
      // print_r($stmt);
      return $stmt;
    }

    function insert(){
      $data_kategori = $this->select();
      $lastId = "";

      if (empty($data_kategori)) {
          $lastId = "K0";
      } else {
          foreach ($data_kategori as $value) {
            $lastId = $value["id"];
          }
      }

      $lastId = explode('K', $lastId);
      $id = $lastId[1];
      $id += 1;
      $newId = "K".$id;

      $sql = "INSERT INTO $this->table_name (id, nama) VALUES (?,?)";
      $this->nama = htmlspecialchars(strip_tags($this->nama));

      if($this->dbh->prepare($sql)->execute([$newId, $this->nama])){
        return true;
      };
      return false;
    }

    function update(){
      $sql = "UPDATE $this->table_name SET nama = ? WHERE id = ?";

      $this->nama = htmlspecialchars(strip_tags($this->nama));
      $this->id = htmlspecialchars(strip_tags($this->id));

      if($this->dbh->prepare($sql)->execute([$this->nama, $this->id])){
        return true;
      }
      return false;
    }

    function delete(){
      $sql = "DELETE FROM $this->table_name WHERE id = ?";

      $this->id = htmlspecialchars(strip_tags($this->id));

      if($this->dbh->prepare($sql)->execute([$this->id])){
        return true;
      }
      return false;
    }
  }

?>
