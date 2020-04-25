<?php

    class Gejala{
      public $id;
      public $nama;
      public $organ_terserang;
      public $tanaman;
      public $table_name = "gejala";

      function __construct($dbh){
        $this->dbh = $dbh;
      }

      function select($column1 = 1, $value1 = 1){
        switch($column1) {
            case 'id':
                $col[] = 'g.id = ?';
                break;
            case 'nama':
                $col[] = 'g.nama = ?';
                break;
            case 'organ_terserang':
                $col[] = 'g.organ_terserang = ?';
                break;
            case 'tanaman':
                $col[] = 'g.tanaman = ?';
                break;
            case 1:
                $col[] = '1 = ?';
                break;
        }
        $sql = "SELECT g.id, g.nama, o.nama AS organ_terserang, t.nama AS tanaman, g.organ_terserang as id_organ_terserang, g.tanaman as id_tanaman FROM gejala AS g JOIN organ AS o ON g.organ_terserang = o.id JOIN tanaman AS t ON g.tanaman = t.id";
        $end = "ORDER BY LPAD(LOWER(g.id), 10,0) ASC";
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
        $newId = null;

        switch ($this->organ_terserang) {
          case 'OR1':
            $akar = $this->select("organ_terserang", "OR1");
            $newId = $this->setId($akar, 'AK');
            break;
          case 'OR2':
            $batang = $this->select("organ_terserang", "OR2");
            $newId = $this->setId($batang, 'BA');
            break;
          case 'OR3':
            $bunga = $this->select("organ_terserang", "OR3");
            $newId = $this->setId($bunga, 'BUN');
            break;
          case 'OR4':
            $daun = $this->select("organ_terserang", "OR4");
            $newId = $this->setId($daun, 'DA');
            break;
          case 'OR5':
            $malai = $this->select("organ_terserang", "OR5");
            $newId = $this->setId($malai, 'MA');
            break;
          case 'OR6':
            $polong = $this->select("organ_terserang", "OR6");
            $newId = $this->setId($polong, 'PO');
            break;
          case 'OR7':
            $tanaman = $this->select("organ_terserang", "OR7");
            $newId = $this->setId($tanaman, 'SEL');
            break;
          case 'OR8':
            $tongkol = $this->select("organ_terserang", "OR8");
            $newId = $this->setId($tongkol, 'TON');
            break;
          case 'OR9':
            $umum = $this->select("organ_terserang", "OR9");
            $newId = $this->setId($umum, 'UMU');
            break;
          default:
            // code...
            break;
        }

        $sql = "INSERT INTO $this->table_name (id, nama, organ_terserang, tanaman) VALUES (?, ?, ?, ?)";
        $this->nama = htmlspecialchars(strip_tags($this->nama));
        $this->organ_terserang = htmlspecialchars(strip_tags($this->organ_terserang));
        $this->tanaman = htmlspecialchars(strip_tags($this->tanaman));

        if($this->dbh->prepare($sql)->execute([$newId, $this->nama, $this->organ_terserang, $this->tanaman])){
          return true;
        };
        return false;
      }

      function update(){
        $sql = "UPDATE $this->table_name SET nama = ?, organ_terserang = ?, tanaman = ? WHERE id = ?";

        $this->nama = htmlspecialchars(strip_tags($this->nama));
        $this->organ_terserang = htmlspecialchars(strip_tags($this->organ_terserang));
        $this->tanaman = htmlspecialchars(strip_tags($this->tanaman));
        $this->id = htmlspecialchars(strip_tags($this->id));

        if($this->dbh->prepare($sql)->execute([$this->nama, $this->organ_terserang, $this->tanaman, $this->id])){
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

      function setId($organ, $notation){
        $lastId = "";
        $id = 0;
        if (empty($organ)) {
            $lastId = $notation."0";
        } else {
            foreach ($organ as $value) {
              $lastId = $value["id"];
            }
        }
        $lastId = explode($notation, $lastId);
        $id = $lastId[1];
        $id += 1;
        return $notation.$id;
      }

      function selectOrgan(){
        $sql = "SELECT DISTINCT gejala.organ_terserang, organ.nama from gejala, organ WHERE gejala.organ_terserang = organ.id and gejala.tanaman = ?";

        $this->tanaman = htmlspecialchars(strip_tags($this->tanaman));

        try{
          $stmt = $this->dbh->prepare($sql);
          $stmt->execute([$this->tanaman]);
          return $stmt->fetchAll(\PDO::FETCH_ASSOC);;
        }catch(PDOException $e){
          echo $e->getMessage();
        }
      }

      function selectOrganTanaman(){
        $sql = "SELECT gejala.id, gejala.nama FROM gejala where gejala.tanaman = ? and gejala.organ_terserang = ?";

        $this->organ_terserang = htmlspecialchars(strip_tags($this->organ_terserang));
        $this->tanaman = htmlspecialchars(strip_tags($this->tanaman));

        try{
          $stmt = $this->dbh->prepare($sql);
          $stmt->execute([$this->tanaman, $this->organ_terserang]);
          return $stmt->fetchAll(\PDO::FETCH_ASSOC);;
        }catch(PDOException $e){
          echo $e->getMessage();
        }
      }

    }


?>
