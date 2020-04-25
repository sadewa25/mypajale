<?php

  class Tanaman{
    public $id;
    public $nama;
    public $deskripsi;
    public $table_name = "tanaman";

    function __construct($dbh){
      $this->dbh = $dbh;
    }

    function select($column = 1, $value = 1, $limit = 'limit'){
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
      $end = "ORDER BY LPAD(LOWER(id), 10,0) ASC LIMIT 3";
      if ($limit !== 'limit') {
        $end = "ORDER BY LPAD(LOWER(id), 10,0) ASC";
      }
      $sql .= " WHERE ".implode(" AND ", $col)." ".$end;
      //cho $sql;
      $stmt = $this->dbh->prepare($sql);
      $stmt->execute([$value]);
      // print_r($stmt);
      return $stmt;
    }

    function insert(){
      $data_tanaman = $this->select(1, 1, 'no');
      $lastId = "";

      if (empty($data_tanaman)) {
          $lastId = "T0";
      } else {
          foreach ($data_tanaman as $value) {
            $lastId = $value["id"];
          }
      }

      $lastId = explode('T', $lastId);
      $id = $lastId[1];
      $id += 1;
      $newId = "T".$id;

      $sql = "INSERT INTO $this->table_name (id, nama, deskripsi) VALUES (?,?,?)";
      $this->nama = htmlspecialchars(strip_tags($this->nama));
      $this->deskripsi = htmlspecialchars(strip_tags($this->deskripsi));

      if($this->dbh->prepare($sql)->execute([$newId, $this->nama, $this->deskripsi])){
        return true;
      };
      return false;
    }

    function update(){
      $sql = "UPDATE $this->table_name SET nama = ?, deskripsi = ? WHERE id = ?";

      $this->nama = htmlspecialchars(strip_tags($this->nama));
      $this->deskripsi = htmlspecialchars(strip_tags($this->deskripsi));
      $this->id = htmlspecialchars(strip_tags($this->id));

      if($this->dbh->prepare($sql)->execute([$this->nama, $this->deskripsi, $this->id])){
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
