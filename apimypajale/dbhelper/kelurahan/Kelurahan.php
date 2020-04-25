<?php

  class Kelurahan{
    public $id_kel;
    public $id_kec;
    public $nama;
    public $id_jenis;
    public $table_name = "kelurahan";

    function __construct($dbh){
      $this->dbh = $dbh;
    }

    function select($column = 1, $value = 1){
      switch($column) {
          case 'id_kel':
              $col[] = 'id_kel = ?';
              break;
          case 'id_kec':
              $col[] = 'id_kec = ?';
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
            $lastId = $value["id_kel"];
          }
      }

      $lastId += 1;
      $newId = $lastId;
      //echo $newId;

      $sql = "INSERT INTO $this->table_name (id_kel, id_kec, nama, id_jenis) VALUES (?, ?, ?, ?)";

      $this->id_kec = htmlspecialchars(strip_tags($this->id_kec));
      $this->nama = htmlspecialchars(strip_tags($this->nama));
      $this->id_jenis = htmlspecialchars(strip_tags($this->id_jenis));

      if($this->dbh->prepare($sql)->execute([$newId, $this->id_kec, $this->nama, $this->id_jenis])){
        return true;
      };
      return false;
    }

    function update(){
      $sql = "UPDATE $this->table_name SET id_kec = ?, nama = ?, id_jenis = ? WHERE id_kel = ?";

      $this->id_kec = htmlspecialchars(strip_tags($this->id_kec));
      $this->nama = htmlspecialchars(strip_tags($this->nama));
      $this->id_jenis = htmlspecialchars(strip_tags($this->id_jenis));
      $this->id_kel = htmlspecialchars(strip_tags($this->id_kel));

      if($this->dbh->prepare($sql)->execute([$this->id_kec, $this->nama, $this->id_jenis, $this->id_kel])){
        return true;
      }
      return false;
    }

    function delete(){
      $sql = "DELETE FROM $this->table_name WHERE id_kel = ?";

      $this->id_kel = htmlspecialchars(strip_tags($this->id_kel));

      if($this->dbh->prepare($sql)->execute([$this->id_kel])){
        return true;
      }
      return false;
    }
  }

?>
