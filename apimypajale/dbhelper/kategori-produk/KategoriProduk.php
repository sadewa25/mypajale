<?php

  class KategoriProduk{
    public $id_kategori_produk;
    public $nama_kategori_produk;
    public $table_name = "kategori_produk";

    function __construct($dbh){
      $this->dbh = $dbh;
    }

    function select($column = 1, $value = 1){
      switch($column) {
          case 'id_kategori_produk':
              $col[] = 'id_kategori_produk = ?';
              break;
          case 'nama_kategori_produk':
              $col[] = 'nama_kategori_produk = ?';
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
      $sql = "INSERT INTO $this->table_name (nama_kategori_produk) VALUES (?)";
      $this->nama_kategori_produk = htmlspecialchars(strip_tags($this->nama_kategori_produk));

      if($this->dbh->prepare($sql)->execute([$this->nama_kategori_produk])){
        return true;
      };
      return false;
    }

    function update(){
      $sql = "UPDATE $this->table_name SET nama_kategori_produk = ? WHERE id_kategori_produk = ?";

      $this->nama_kategori_produk = htmlspecialchars(strip_tags($this->nama_kategori_produk));
      $this->id_kategori_produk = htmlspecialchars(strip_tags($this->id_kategori_produk));

      if($this->dbh->prepare($sql)->execute([$this->nama_kategori_produk, $this->id_kategori_produk])){
        return true;
      }
      return false;
    }

    function delete(){
      $sql = "DELETE FROM $this->table_name WHERE id_kategori_produk = ?";

      $this->id_kategori_produk = htmlspecialchars(strip_tags($this->id_kategori_produk));

      if($this->dbh->prepare($sql)->execute([$this->id_kategori_produk])){
        return true;
      }
      return false;
    }
  }

?>
