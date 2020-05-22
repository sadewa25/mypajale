<?php

    class LaporanOPT {
      public $id_laporan_opt;
      public $id_user;
      public $judul_laporan;
      public $id_penyakit;
      public $id_kab;
      public $id_kec;
      public $desa;
      public $nama_kelompok_tani;
      public $id_jenis_tanaman;
      public $varietas;
      public $umur;
      public $intensitas_serangan;
      public $luas_tersrang;
      public $luas_hamparan;
      public $gambar;
      public $tanggal;
      public $jenis_musuh_alami;
      public $kesimpulan;
      public $rekomendasi;
      public $table_name = "laporan_opt";

      function __construct($dbh){
        $this->dbh = $dbh;
      }

      function select($column1 = 1, $value1 = 1){
        switch($column1) {
            case 'id_laporan_opt':
                $col[] = 'laporan_opt.id_laporan_opt = ?';
                break;
            case 'judul_laporan_opt':
                $col[] = 'laporan_opt.judul_laporan_opt = ?';
                break;
            case 'id_user':
                $col[] = 'laporan_opt.id_user = ?';
                break;
            case 1:
                $col[] = '1 = ?';
                break;
        }
        $sql = "SELECT
              laporan_opt.id_laporan_opt,
              kabupaten.nama AS kabupaten,
              kecamatan.nama AS kecamatan,
              laporan_opt.judul_laporan,
              users.nama_lengkap,
              tanaman.nama as tanaman,
              laporan_opt.desa,
              opt.nama as nama_opt,
              laporan_opt.nama_kelompok_tani,
              laporan_opt.varietas,
              laporan_opt.umur,
              laporan_opt.intensitas_serangan,
              laporan_opt.luas_terserang,
              laporan_opt.luas_hamparan,
              laporan_opt.gambar,
              laporan_opt.tanggal,
              laporan_opt.jenis_musuh_alami,
              laporan_opt.kesimpulan,
              laporan_opt.rekomendasi,
              laporan_opt.id_penyakit,
              laporan_opt.id_kab,
              laporan_opt.id_kec,
              laporan_opt.id_jenis_tanaman,
              laporan_opt.id_user,
              laporan_opt.gambar
              FROM
              $this->table_name
              INNER JOIN kabupaten ON laporan_opt.id_kab = kabupaten.id_kab
              INNER JOIN kecamatan ON laporan_opt.id_kec = kecamatan.id_kec
              INNER JOIN tanaman ON laporan_opt.id_jenis_tanaman = tanaman.id
              INNER JOIN users ON users.id_users = laporan_opt.id_user
              INNER JOIN opt ON laporan_opt.id_penyakit = opt.id";
        //$sql = "SELECT * FROM $this->table_name";
        $end = "ORDER BY laporan_opt.id_laporan_opt DESC";
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
        $sql = "INSERT INTO $this->table_name (id_user, judul_laporan, id_penyakit, id_kab, id_kec,
                                                desa, nama_kelompok_tani, id_jenis_tanaman, varietas, umur,
                                                intensitas_serangan, luas_terserang, luas_hamparan, gambar,
                                                tanggal, jenis_musuh_alami, kesimpulan, rekomendasi)
                                                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $this->id_user = htmlspecialchars(strip_tags($this->id_user ));
        $this->judul_laporan = htmlspecialchars(strip_tags($this->judul_laporan ));
        $this->id_penyakit = htmlspecialchars(strip_tags($this->id_penyakit ));
        $this->id_kab = htmlspecialchars(strip_tags($this->id_kab ));
        $this->id_kec = htmlspecialchars(strip_tags($this->id_kec ));
        $this->desa = htmlspecialchars(strip_tags($this->desa ));
        $this->nama_kelompok_tani = htmlspecialchars(strip_tags($this->nama_kelompok_tani ));
        $this->id_jenis_tanaman = htmlspecialchars(strip_tags($this->id_jenis_tanaman ));
        $this->varietas = htmlspecialchars(strip_tags($this->varietas ));
        $this->umur = htmlspecialchars(strip_tags($this->umur ));
        $this->intensitas_serangan = htmlspecialchars(strip_tags($this->intensitas_serangan ));
        $this->luas_tersrang = htmlspecialchars(strip_tags($this->luas_tersrang ));
        $this->luas_hamparan = htmlspecialchars(strip_tags($this->luas_hamparan ));
        $this->gambar = htmlspecialchars(strip_tags($this->gambar ));
        $this->tanggal = htmlspecialchars(strip_tags($this->tanggal ));
        $this->jenis_musuh_alami = htmlspecialchars(strip_tags($this->jenis_musuh_alami ));
        $this->kesimpulan = htmlspecialchars(strip_tags($this->kesimpulan ));
        $this->rekomendasi = htmlspecialchars(strip_tags($this->rekomendasi ));

        if($this->dbh->prepare($sql)->execute([$this->id_user, $this->judul_laporan,$this->id_penyakit,
                                              $this->id_kab,$this->id_kec,$this->desa,$this->nama_kelompok_tani,
                                              $this->id_jenis_tanaman,$this->varietas,$this->umur,
                                              $this->intensitas_serangan,$this->luas_tersrang,$this->luas_hamparan,
                                              $this->gambar,$this->tanggal,$this->jenis_musuh_alami,
                                              $this->kesimpulan,$this->rekomendasi])){
          return true;
        };
        return false;
      }

      function update(){
        $sql = "UPDATE $this->table_name SET id_user = ?, judul_laporan = ?, id_penyakit = ?, id_kab = ?, id_kec = ?,
                                                desa = ?, nama_kelompok_tani = ?, id_jenis_tanaman = ?, varietas = ?, umur = ?,
                                                intensitas_serangan = ?, luas_terserang = ?, luas_hamparan = ?, gambar = ?,
                                                tanggal = ?, jenis_musuh_alami = ?, kesimpulan = ?, rekomendasi = ? WHERE id_laporan_opt = ?";

        $this->id_user = htmlspecialchars(strip_tags($this->id_user ));
        $this->judul_laporan = htmlspecialchars(strip_tags($this->judul_laporan ));
        $this->id_penyakit = htmlspecialchars(strip_tags($this->id_penyakit ));
        $this->id_kab = htmlspecialchars(strip_tags($this->id_kab ));
        $this->id_kec = htmlspecialchars(strip_tags($this->id_kec ));
        $this->desa = htmlspecialchars(strip_tags($this->desa ));
        $this->nama_kelompok_tani = htmlspecialchars(strip_tags($this->nama_kelompok_tani ));
        $this->id_jenis_tanaman = htmlspecialchars(strip_tags($this->id_jenis_tanaman ));
        $this->varietas = htmlspecialchars(strip_tags($this->varietas ));
        $this->umur = htmlspecialchars(strip_tags($this->umur ));
        $this->intensitas_serangan = htmlspecialchars(strip_tags($this->intensitas_serangan ));
        $this->luas_tersrang = htmlspecialchars(strip_tags($this->luas_tersrang ));
        $this->luas_hamparan = htmlspecialchars(strip_tags($this->luas_hamparan ));
        $this->gambar = htmlspecialchars(strip_tags($this->gambar ));
        $this->tanggal = htmlspecialchars(strip_tags($this->tanggal ));
        $this->jenis_musuh_alami = htmlspecialchars(strip_tags($this->jenis_musuh_alami ));
        $this->kesimpulan = htmlspecialchars(strip_tags($this->kesimpulan ));
        $this->rekomendasi = htmlspecialchars(strip_tags($this->rekomendasi ));
        $this->id_laporan_opt = htmlspecialchars(strip_tags($this->id_laporan_opt ));

        if($this->dbh->prepare($sql)->execute([$this->id_user, $this->judul_laporan,$this->id_penyakit,
                                              $this->id_kab,$this->id_kec,$this->desa,$this->nama_kelompok_tani,
                                              $this->id_jenis_tanaman,$this->varietas,$this->umur,
                                              $this->intensitas_serangan,$this->luas_tersrang,$this->luas_hamparan,
                                              $this->gambar,$this->tanggal,$this->jenis_musuh_alami,
                                              $this->kesimpulan,$this->rekomendasi,$this->id_laporan_opt])){
          return true;
        }
        return false;
      }

      function delete(){
        $sql = "DELETE FROM $this->table_name WHERE id_laporan_opt = ?";

        $this->id_laporan_opt = htmlspecialchars(strip_tags($this->id_laporan_opt));

        if($this->dbh->prepare($sql)->execute([$this->id_laporan_opt])){
          return true;
        }
        return false;
      }
    }


?>
