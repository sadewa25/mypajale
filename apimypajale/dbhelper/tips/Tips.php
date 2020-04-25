<?php

    class Tips {
      public $id_tips;
      public $judul_tips;
      public $gambar_tips;
      public $deskripsi_tips;
      public $judul_usaha;
      public $id_users;
      public $id_kategori_tips;
      public $id_tanaman;
      public $table_name = "tips";

      function __construct($dbh){
        $this->dbh = $dbh;
      }

      function select($column1 = 1, $value1 = 1){
        switch($column1) {
            case 'id_tips':
                $col[] = 'tips.id_tips = ?';
                break;
            case 'judul_tips':
                $col[] = 'tips.judul_tips = ?';
                break;
            case 'id_users':
                $col[] = 'tips.id_users = ?';
                break;
            case 1:
                $col[] = '1 = ?';
                break;
        }
        $sql = "SELECT tips.id_tips, tips.judul_tips, tips.gambar_tips,
                    	tips.deskripsi_tips, tips.id_users, tips.id_kategori_tips,
                      users.nama_lengkap, kategori_tips.nama_kategori_tips, tips.id_tanaman, tips.id_users, tanaman.nama AS tanaman
                    	FROM $this->table_name
                    	INNER JOIN users ON users.id_users = tips.id_users
                      INNER JOIN tanaman ON tanaman.id = tips.id_tanaman
                    	INNER JOIN kategori_tips ON kategori_tips.id_kategori_tips = tips.id_kategori_tips";
        //$sql = "SELECT * FROM $this->table_name";
        $end = "ORDER BY tips.id_tips DESC";
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
        $sql = "INSERT INTO $this->table_name (judul_tips, gambar_tips, deskripsi_tips, id_users, id_kategori_tips, id_tanaman) VALUES (?,?,?,?,?,?)";

        $this->judul_tips = htmlspecialchars(strip_tags($this->judul_tips));
        $this->gambar_tips = htmlspecialchars(strip_tags($this->gambar_tips));
        $this->deskripsi_tips = htmlspecialchars(strip_tags($this->deskripsi_tips));
        $this->id_users = htmlspecialchars(strip_tags($this->id_users));
        $this->id_kategori_tips = htmlspecialchars(strip_tags($this->id_kategori_tips));
        $this->id_tanaman = htmlspecialchars(strip_tags($this->id_tanaman));

        if($this->dbh->prepare($sql)->execute([$this->judul_tips, $this->gambar_tips, $this->deskripsi_tips,
                                                $this->id_users, $this->id_kategori_tips, $this->id_tanaman])){
          return true;
        };
        return false;
      }

      function update(){
        $sql = "UPDATE $this->table_name SET judul_tips = ?, gambar_tips = ?, deskripsi_tips = ?, id_users = ?, id_kategori_tips = ?, id_tanaman = ? WHERE id_tips = ?";

        $this->judul_tips = htmlspecialchars(strip_tags($this->judul_tips));
        $this->gambar_tips = htmlspecialchars(strip_tags($this->gambar_tips));
        $this->deskripsi_tips = htmlspecialchars(strip_tags($this->deskripsi_tips));
        $this->id_users = htmlspecialchars(strip_tags($this->id_users));
        $this->id_kategori_tips = htmlspecialchars(strip_tags($this->id_kategori_tips));
        $this->id_tanaman = htmlspecialchars(strip_tags($this->id_tanaman));
        $this->id_tips = htmlspecialchars(strip_tags($this->id_tips));

        if($this->dbh->prepare($sql)->execute([$this->judul_tips, $this->gambar_tips, $this->deskripsi_tips,
                                                $this->id_users, $this->id_kategori_tips,$this->id_tanaman, $this->id_tips,])){
          return true;
        }
        return false;
      }

      function delete(){
        $sql = "DELETE FROM $this->table_name WHERE id_tips = ?";

        $this->id_tips = htmlspecialchars(strip_tags($this->id_tips));

        if($this->dbh->prepare($sql)->execute([$this->id_tips])){
          return true;
        }
        return false;
      }
    }


?>
