<?php

  class Kecamatan{
    public $id_kec;
    public $id_kab;
    public $nama;
    public $table_name = "kecamatan";

    function __construct($dbh){
      $this->dbh = $dbh;
    }

    function select($column = 1, $value = 1){
      switch($column) {
          case 'id_kec':
              $col[] = 'id_kec = ?';
              break;
          case 'id_kab':
              $col[] = 'id_kab = ?';
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
            $lastId = $value["id_kec"];
          }
      }

      $lastId += 1;
      $newId = $lastId;
      //echo $newId;

      $sql = "INSERT INTO $this->table_name (id_kec, id_kab, nama) VALUES (?, ?, ?)";

      $this->id_kab = htmlspecialchars(strip_tags($this->id_kab));
      $this->nama = htmlspecialchars(strip_tags($this->nama));

      if($this->dbh->prepare($sql)->execute([$newId, $this->id_kab, $this->nama])){
        return true;
      };
      return false;
    }

    function update(){
      $sql = "UPDATE $this->table_name SET id_kab = ?, nama = ? WHERE id_kec = ?";

      $this->id_kab = htmlspecialchars(strip_tags($this->id_kab));
      $this->nama = htmlspecialchars(strip_tags($this->nama));
      $this->id_kec = htmlspecialchars(strip_tags($this->id_kec));

      if($this->dbh->prepare($sql)->execute([$this->id_kab, $this->nama, $this->id_kec])){
        return true;
      }
      return false;
    }

    function delete(){
      $sql = "DELETE FROM $this->table_name WHERE id_kec = ?";

      $this->id_kec = htmlspecialchars(strip_tags($this->id_kec));

      if($this->dbh->prepare($sql)->execute([$this->id_kec])){
        return true;
      }
      return false;
    }
  }

?>
