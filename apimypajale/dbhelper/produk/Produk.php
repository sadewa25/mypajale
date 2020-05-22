<?php

    class Produk {
      public $id_produk;
      public $nama_produk;
      public $gambar_produk;
      public $deskripsi_produk;
      public $nama_usaha;
      public $id_users;
      public $id_kategori_produk;
      public $id_tanaman;
      public $table_name = "produk";

      function __construct($dbh){
        $this->dbh = $dbh;
      }

      function select($column1 = 1, $value1 = 1){
        switch($column1) {
            case 'id_produk':
                $col[] = 'produk.id_produk = ?';
                break;
            case 'nama_produk':
                $col[] = 'produk.nama_produk = ?';
                break;
            case 'id_users':
                $col[] = 'produk.id_users = ?';
                break;
            case 1:
                $col[] = '1 = ?';
                break;
        }
        $sql = "SELECT produk.id_produk, produk.nama_produk, produk.gambar_produk,
                    	produk.deskripsi_produk, produk.nama_usaha, produk.id_users,
                    	produk.id_kategori_produk, users.nama_lengkap, kategori_produk.nama_kategori_produk, produk.id_tanaman, produk.id_users, tanaman.nama AS tanaman
                    	FROM $this->table_name
                    	INNER JOIN users ON users.id_users = produk.id_users
                    	INNER JOIN kategori_produk ON kategori_produk.id_kategori_produk = produk.id_kategori_produk
                      INNER JOIN tanaman ON produk.id_tanaman = tanaman.id";
        // $sql = "SELECT * FROM $this->table_name";
        $end = "ORDER BY produk.id_produk DESC";
        $sql .= " WHERE ".implode(" AND ", $col)." ".$end;
        //echo $sql;
        try{
          $stmt = $this->dbh->prepare($sql);
          $stmt->execute([$value1]);
          // print_r($stmt->fetchAll(\PDO::FETCH_ASSOC));
          return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }catch(PDOException $e){
          echo $e->getMessage();
        }

      }

      function insert(){
        $sql = "INSERT INTO $this->table_name (nama_produk, gambar_produk, deskripsi_produk, nama_usaha, id_users, id_kategori_produk, id_tanaman) VALUES (?,?,?,?,?,?,?)";

        $this->nama_produk = htmlspecialchars(strip_tags($this->nama_produk));
        $this->gambar_produk = htmlspecialchars(strip_tags($this->gambar_produk));
        $this->deskripsi_produk = htmlspecialchars(strip_tags($this->deskripsi_produk));
        $this->nama_usaha = htmlspecialchars(strip_tags($this->nama_usaha));
        $this->id_users = htmlspecialchars(strip_tags($this->id_users));
        $this->id_kategori_produk = htmlspecialchars(strip_tags($this->id_kategori_produk));
        $this->id_tanaman = htmlspecialchars(strip_tags($this->id_tanaman));

        if($this->dbh->prepare($sql)->execute([$this->nama_produk, $this->gambar_produk, $this->deskripsi_produk,
                                                $this->nama_usaha, $this->id_users, $this->id_kategori_produk, $this->id_tanaman])){
          return true;
        };
        return false;
      }

      function update(){
        $sql = "UPDATE $this->table_name SET nama_produk = ?, gambar_produk = ?, deskripsi_produk = ?, nama_usaha = ?, id_users = ?, id_kategori_produk = ?, id_tanaman = ? WHERE id_produk = ?";

        $this->nama_produk = htmlspecialchars(strip_tags($this->nama_produk));
        $this->gambar_produk = htmlspecialchars(strip_tags($this->gambar_produk));
        $this->deskripsi_produk = htmlspecialchars(strip_tags($this->deskripsi_produk));
        $this->nama_usaha = htmlspecialchars(strip_tags($this->nama_usaha));
        $this->id_users = htmlspecialchars(strip_tags($this->id_users));
        $this->id_kategori_produk = htmlspecialchars(strip_tags($this->id_kategori_produk));
        $this->id_produk = htmlspecialchars(strip_tags($this->id_produk));
        $this->id_tanaman = htmlspecialchars(strip_tags($this->id_tanaman));

        if($this->dbh->prepare($sql)->execute([$this->nama_produk, $this->gambar_produk, $this->deskripsi_produk,
                                                $this->nama_usaha, $this->id_users, $this->id_kategori_produk, $this->id_tanaman, $this->id_produk])){
          return true;
        }
        return false;
      }

      function delete(){
        $sql = "DELETE FROM $this->table_name WHERE id_produk = ?";

        $this->id_produk = htmlspecialchars(strip_tags($this->id_produk));

        if($this->dbh->prepare($sql)->execute([$this->id_produk])){
          return true;
        }
        return false;
      }
    }


?>
