<?php

  class Konfigurasi{
    public $id_konfigurasi;
    public $nama_konfigurasi;
    public $versi_konfigurasi;
    public $table_name = "konfigurasi";

    function __construct($dbh){
      $this->dbh = $dbh;
    }

    function select($column = 1, $value = 1){
      switch($column) {
          case 'id_konfiguasi':
              $col[] = 'id_konfiguasi = ?';
              break;
          case 'nama_konfigurasi':
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
            $lastId = $value["id_konfigurasi"];
          }
      }

      $lastId += 1;
      $newId = $lastId;
      //echo $newId;

      $sql = "INSERT INTO $this->table_name (id_konfigurasi, id_prov, nama, id_jenis) VALUES (?, ?, ?, ?)";

      $this->id_prov = htmlspecialchars(strip_tags($this->id_prov));
      $this->nama = htmlspecialchars(strip_tags($this->nama));
      $this->id_jenis = htmlspecialchars(strip_tags($this->id_jenis));

      if($this->dbh->prepare($sql)->execute([$newId, $this->id_prov, $this->nama, $this->id_jenis])){
        return true;
      };
      return false;
    }

    function update(){
      $sql = "UPDATE $this->table_name SET id_prov = ?, nama = ?, id_jenis = ? WHERE id_konfigurasi = ?";

      $this->id_prov = htmlspecialchars(strip_tags($this->id_prov));
      $this->nama = htmlspecialchars(strip_tags($this->nama));
      $this->id_jenis = htmlspecialchars(strip_tags($this->id_jenis));
      $this->id_konfigurasi = htmlspecialchars(strip_tags($this->id_konfigurasi));

      if($this->dbh->prepare($sql)->execute([$this->id_prov, $this->nama, $this->id_jenis, $this->id_konfigurasi])){
        return true;
      }
      return false;
    }

    function delete(){
      $sql = "DELETE FROM $this->table_name WHERE id_konfigurasi = ?";

      $this->id_konfigurasi = htmlspecialchars(strip_tags($this->id_konfigurasi));

      if($this->dbh->prepare($sql)->execute([$this->id_konfigurasi])){
        return true;
      }
      return false;
    }
  }

?>
