<?php
    class Opt{
      public $id;
      public $nama;
      public $gejala;
      public $gambar_opt;
      public $solusi;
      public $kategori;
      public $organisme;
      public $tanaman;
      public $deskripsi_opt;
      public $table_name = "opt";

      function __construct($dbh){
        $this->dbh = $dbh;
      }

      function select($column1 = 1, $value1 = 1){
        switch($column1) {
            case 'id':
                $col[] = 'p.id = ?';
                break;
            case 'nama':
                $col[] = 'p.nama = ?';
                break;
            case 'kategori':
                $col[] = 'p.kategori = ?';
                break;
            case 'organisme':
                $col[] = 'p.organisme = ?';
                break;
            case 'tanaman':
                $col[] = 'p.tanaman = ?';
                break;
            case 1:
                $col[] = '1 = ?';
                break;
        }
        //$sql = "SELECT * FROM $this->table_name";
        $sql = "SELECT p.id, p.nama, p.gejala, p.gambar_opt,
                  p.solusi, p.deskripsi_opt, k.nama AS kategori, p.kategori AS id_kategori,
                  og.nama AS organisme, t.nama AS tanaman,
                  p.organisme AS id_organisme, p.tanaman AS id_tanaman
                  FROM $this->table_name AS p
                  INNER JOIN kategori_opt AS k ON p.kategori = k.id
                  INNER JOIN organisme AS og ON p.organisme = og.id
                  INNER JOIN tanaman AS t ON p.tanaman = t.id";
        $end = "ORDER BY LPAD(LOWER(p.id), 10,0) ASC";
        $sql .= " WHERE ".implode(" AND ", $col)." ".$end;
        //echo $sql;
        try{
          $stmt = $this->dbh->prepare($sql);
          $stmt->execute([$value1]);
          // print_r($stmt);
          return $stmt->fetchAll(\PDO::FETCH_ASSOC);;
        }catch(PDOException $e){
          echo $e->getMessage();
        }

      }

      function insert(){
        $idOPT = $this->select();
        $lastId = "";
        if (empty($idOPT)) {
            $lastId = "OPT0";
        }else{
            foreach ($idOPT as $value) {
              $lastId = $value["id"];
            }
        }
        $lastId = explode('OPT', $lastId);
        $id = $lastId[1];
        $id+=1;
        $newId= "OPT".$id;
        echo $newId;
        $sql = "INSERT INTO $this->table_name (id, nama, gejala, gambar_opt,
                                                solusi, kategori, organisme,
                                                tanaman, deskripsi_opt) VALUES (?,?,?,?,?,?,?,?,?)";
        $this->nama = htmlspecialchars(strip_tags($this->nama));
        $this->gejala = htmlspecialchars(strip_tags($this->gejala));
        $this->gambar_opt = htmlspecialchars(strip_tags($this->gambar_opt));
        $this->solusi = htmlspecialchars(strip_tags($this->solusi));
        $this->kategori = htmlspecialchars(strip_tags($this->kategori));
        $this->organisme = htmlspecialchars(strip_tags($this->organisme));
        $this->tanaman = htmlspecialchars(strip_tags($this->tanaman));
        $this->deskripsi_opt = htmlspecialchars(strip_tags($this->deskripsi_opt));
        echo $sql;

        if($this->dbh->prepare($sql)->execute([$newId, $this->nama, $this->gejala,
                                              $this->gambar_opt, $this->solusi, $this->kategori,
                                              $this->organisme, $this->tanaman, $this->deskripsi_opt])){
          return true;
        };
        return false;
      }

      function update(){
        $sql = "UPDATE $this->table_name SET nama = ?, gejala = ?, gambar_opt = ?, solusi = ?, kategori = ?, organisme = ?, tanaman = ?, deskripsi_opt = ? WHERE id = ?";

        $this->nama = htmlspecialchars(strip_tags($this->nama));
        $this->gejala = htmlspecialchars(strip_tags($this->gejala));
        $this->gambar_opt = htmlspecialchars(strip_tags($this->gambar_opt));
        $this->solusi = htmlspecialchars(strip_tags($this->solusi));
        $this->kategori = htmlspecialchars(strip_tags($this->kategori));
        $this->organisme = htmlspecialchars(strip_tags($this->organisme));
        $this->tanaman = htmlspecialchars(strip_tags($this->tanaman));
        $this->deskripsi_opt = htmlspecialchars(strip_tags($this->deskripsi_opt));
        $this->id = htmlspecialchars(strip_tags($this->id));

        if($this->dbh->prepare($sql)->execute([$this->nama, $this->gejala, $this->gambar_opt, $this->solusi, $this->kategori, $this->organisme, $this->tanaman, $this->deskripsi_opt, $this->id])){
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
