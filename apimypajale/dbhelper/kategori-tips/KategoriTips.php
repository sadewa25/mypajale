<?php

  class KategoriTips{
    public $id_kategori_tips;
    public $nama_kategori_tips;
    public $keterangan_kategori_tips;
    public $table_name = "kategori_tips";

    function __construct($dbh){
      $this->dbh = $dbh;
    }

    function select($column = 1, $value = 1){
      switch($column) {
          case 'id_kategori_tips':
              $col[] = 'id_kategori_tips = ?';
              break;
          case 'nama_kategori_tips':
              $col[] = 'nama_kategori_tips = ?';
              break;
          case 1:
              $col[] = '1 = ?';
              break;
      }
      $sql = "SELECT * FROM $this->table_name";
      // $end = "ORDER BY LPAD(LOWER(id), 10,0) ASC";
      $sql .= " WHERE ".implode(" AND ", $col); //." ".$end
      //echo $sql;
      $stmt = $this->dbh->prepare($sql);
      $stmt->execute([$value]);
      // print_r($stmt);
      return $stmt;
    }

    function insert(){
      $sql = "INSERT INTO $this->table_name (nama_kategori_tips, keterangan_kategori_tips) VALUES (?, ?)";
      $this->nama_kategori_tips = htmlspecialchars(strip_tags($this->nama_kategori_tips));
      $this->keterangan_kategori_tips = htmlspecialchars(strip_tags($this->keterangan_kategori_tips));

      if($this->dbh->prepare($sql)->execute([$this->nama_kategori_tips, $this->keterangan_kategori_tips])){
        return true;
      };
      return false;
    }

    function update(){
      $sql = "UPDATE $this->table_name SET nama_kategori_tips = ?, keterangan_kategori_tips = ? WHERE id_kategori_tips = ?";

      $this->nama_kategori_tips = htmlspecialchars(strip_tags($this->nama_kategori_tips));
      $this->keterangan_kategori_tips = htmlspecialchars(strip_tags($this->keterangan_kategori_tips));
      $this->id_kategori_tips = htmlspecialchars(strip_tags($this->id_kategori_tips));

      if($this->dbh->prepare($sql)->execute([$this->nama_kategori_tips, $this->keterangan_kategori_tips, $this->id_kategori_tips])){
        return true;
      }
      return false;
    }

    function delete(){
      $sql = "DELETE FROM $this->table_name WHERE id_kategori_tips = ?";

      $this->id_kategori_tips = htmlspecialchars(strip_tags($this->id_kategori_tips));

      if($this->dbh->prepare($sql)->execute([$this->id_kategori_tips])){
        return true;
      }
      return false;
    }
  }

?>
