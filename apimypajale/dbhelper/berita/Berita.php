<?php

    class Berita{
      public $id_berita;
      public $judul_berita;
      public $deskripsi_berita;
      public $tgl_berita;
      public $gambar_berita;
      public $id_users;
      public $table_name = "berita";

      function __construct($dbh){
        $this->dbh = $dbh;
      }

      function select($column1 = 1, $value1 = 1){
        switch($column1) {
            case 'id_berita':
                $col[] = 'b.id_berita = ?';
                break;
            case 'judul_berita':
                $col[] = 'b.judul_berita = ?';
                break;
            case 'id_users':
                $col[] = 'b.id_users = ?';
                break;
            case 1:
                $col[] = '1 = ?';
                break;
        }
        $sql = "SELECT b.id_berita, b.judul_berita, b.deskripsi_berita,
                       b.tgl_berita, b.gambar_berita, t.nama AS tanaman,
                       b.id_tanaman, b.id_users, u.nama_lengkap
                       FROM $this->table_name AS b
                INNER JOIN users AS u ON u.id_users = b.id_users
                INNER JOIN tanaman AS t ON t.id = b.id_tanaman";
        // $sql = "SELECT * FROM $this->table_name";
        $end = "ORDER BY b.id_berita DESC";
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
        $sql = "INSERT INTO $this->table_name (judul_berita, deskripsi_berita, tgl_berita, gambar_berita, id_users, id_tanaman) VALUES (?,?,?,?,?,?)";

        $this->judul_berita = htmlspecialchars(strip_tags($this->judul_berita));
        $this->deskripsi_berita = htmlspecialchars(strip_tags($this->deskripsi_berita));
        $this->tgl_berita = htmlspecialchars(strip_tags($this->tgl_berita));
        $this->gambar_berita = htmlspecialchars(strip_tags($this->gambar_berita));
        $this->id_users = htmlspecialchars(strip_tags($this->id_users));
        $this->id_tanaman = htmlspecialchars(strip_tags($this->id_tanaman));

        if($this->dbh->prepare($sql)->execute([$this->judul_berita, $this->deskripsi_berita, $this->tgl_berita,
                                                $this->gambar_berita, $this->id_users, $this->id_tanaman])){
          return true;
        };
        return false;
      }

      function update(){
        $sql = "UPDATE $this->table_name SET judul_berita = ?, deskripsi_berita = ?, tgl_berita = ?, gambar_berita = ?, id_users = ?, id_tanaman = ? WHERE id_berita = ?";

        $this->judul_berita = htmlspecialchars(strip_tags($this->judul_berita));
        $this->deskripsi_berita = htmlspecialchars(strip_tags($this->deskripsi_berita));
        $this->tgl_berita = htmlspecialchars(strip_tags($this->tgl_berita));
        $this->gambar_berita = htmlspecialchars(strip_tags($this->gambar_berita));
        $this->id_users = htmlspecialchars(strip_tags($this->id_users));
        $this->id_tanaman = htmlspecialchars(strip_tags($this->id_tanaman));
        $this->id_berita = htmlspecialchars(strip_tags($this->id_berita));


        if($this->dbh->prepare($sql)->execute([$this->judul_berita, $this->deskripsi_berita, $this->tgl_berita,
                                                $this->gambar_berita, $this->id_users, $this->id_tanaman, $this->id_berita])){
          return true;
        }
        return false;
      }

      function delete(){
        $sql = "DELETE FROM $this->table_name WHERE id_berita = ?";

        $this->id_berita = htmlspecialchars(strip_tags($this->id_berita));

        if($this->dbh->prepare($sql)->execute([$this->id_berita])){
          return true;
        }
        return false;
      }
    }


?>
