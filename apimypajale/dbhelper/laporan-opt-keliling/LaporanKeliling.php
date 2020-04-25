<?php

    class LaporanKeliling {
      public $id_laporan_opt;
      public $id_user;
      public $judul_laporan;
      public $id_penyakit;
      public $id_kec;
      public $desa;
      public $id_jenis_tanaman;
      public $varietas;
      public $umur;
      public $intensitas_serangan;
      public $luas_terserang;
      public $luas_hamparan;
      public $gambar;
      public $tanggal;
      public $jenis_musuh_alami;
      public $kesimpulan;
      public $rekomendasi;
      public $id_status_report;
      public $keterangan_tanaman;
      public $nip_koordinator;
      public $table_name = "laporan_opt_keliling";

      function __construct($dbh){
        $this->dbh = $dbh;
      }

      function select($column1 = 1, $value1 = 1){
        switch($column1) {
            case 'id_laporan_opt':
                $col[] = 'laporan_opt_keliling.id_laporan_opt = ?';
                break;
            case 'judul_laporan_opt':
                $col[] = 'laporan_opt_keliling.judul_laporan_opt = ?';
                break;
            case 'id_user':
                $col[] = 'laporan_opt_keliling.id_user = ?';
                break;
            case 'nip_koordinator':
                $col[] = 'users.id_koordinator = ?';
                break;
            case 1:
                $col[] = '1 = ?';
                break;
        }

        //$sql = "SELECT * FROM $this->table_name";
        $sql = "SELECT
        	laporan_opt_keliling.id_laporan_opt,
        	laporan_opt_keliling.id_user,
          users.nama_lengkap as nama_pegawai,
        	laporan_opt_keliling.judul_laporan,
        	laporan_opt_keliling.id_penyakit,
          opt.nama as nama_penyakit,
        	laporan_opt_keliling.id_kec,
        	laporan_opt_keliling.desa,
        	laporan_opt_keliling.id_jenis_tanaman,
          tanaman.nama as nama_tanaman,
        	laporan_opt_keliling.varietas,
        	laporan_opt_keliling.umur,
        	laporan_opt_keliling.intensitas_serangan,
        	laporan_opt_keliling.luas_terserang,
        	laporan_opt_keliling.luas_hamparan,
        	laporan_opt_keliling.gambar,
        	laporan_opt_keliling.tanggal,
        	laporan_opt_keliling.jenis_musuh_alami,
        	laporan_opt_keliling.kesimpulan,
        	laporan_opt_keliling.rekomendasi,
        	laporan_opt_keliling.id_status_report,
          laporan_opt_keliling.keterangan_tanaman,
        	status_report.nama_status_report
        FROM
        	$this->table_name
        INNER JOIN users ON users.id_users = laporan_opt_keliling.id_user
        INNER JOIN opt ON opt.id = laporan_opt_keliling.id_penyakit
        INNER JOIN tanaman ON tanaman.id = laporan_opt_keliling.id_jenis_tanaman
        INNER JOIN status_report ON status_report.id_status_report = laporan_opt_keliling.id_status_report";
        $end = "ORDER BY laporan_opt_keliling.id_laporan_opt DESC";
        $sql .= " WHERE ".implode(" AND ", $col)." ".$end;
        //echo $sql;
        $day = date('j');
        $month = date('n');
        $year = date('Y');
        $date = "'".date('Y-m-d')."'";
        //echo $date;
        $count = "SELECT
                  (
                  	SELECT
                  		COUNT(
                  			laporan_opt_keliling.id_laporan_opt
                  		)
                  	FROM
                  		laporan_opt_keliling
                  	WHERE
                  		MONTH (
                  			laporan_opt_keliling.tanggal
                  		) = $month
                  	AND YEAR (
                  	laporan_opt_keliling.tanggal
                  ) = $year
                  ) as laporan_bulanan,
                  (
                  	SELECT
                  		COUNT(
                  			laporan_opt_keliling.id_laporan_opt
                  		)
                  	FROM
                  		laporan_opt_keliling
                  	WHERE laporan_opt_keliling.tanggal = $date
                  ) as laporan_harian";
        //echo $count;
        try{
          $stmt = $this->dbh->prepare($sql);
          $stmt->execute([$value1]);
          $stmt_count = $this->dbh->prepare($count);
          $stmt_count->execute();
          // //print_r($stmt_count->fetchAll(\PDO::FETCH_ASSOC));
          $data = [$stmt->fetchAll(\PDO::FETCH_ASSOC), $stmt_count->fetchAll(\PDO::FETCH_ASSOC)];
          // //print_r($stmt->fetchAll(\PDO::FETCH_ASSOC));
          // print_r($data);
          return $data;
        }catch(PDOException $e){
          echo $e->getMessage();
        }

      }

      function insert(){
        $sql = "INSERT INTO $this->table_name (id_user, judul_laporan, id_penyakit, id_kec,
                                                desa, id_jenis_tanaman, varietas, umur,
                                                intensitas_serangan, luas_terserang, luas_hamparan, gambar,
                                                tanggal, jenis_musuh_alami, kesimpulan, rekomendasi, id_status_report, keterangan_tanaman)
                                                VALUES (?, ?, ?, ?, ?, ?,
                                                        ?, ?, ?, ?, ?, ?,
                                                        ?, ?, ?, ?, ?, ?)";

        $this->id_user = htmlspecialchars(strip_tags($this->id_user ));
        $this->judul_laporan = htmlspecialchars(strip_tags($this->judul_laporan ));
        $this->id_penyakit = htmlspecialchars(strip_tags($this->id_penyakit ));
        $this->id_kec = htmlspecialchars(strip_tags($this->id_kec ));
        $this->desa = htmlspecialchars(strip_tags($this->desa ));
        $this->id_jenis_tanaman = htmlspecialchars(strip_tags($this->id_jenis_tanaman ));
        $this->varietas = htmlspecialchars(strip_tags($this->varietas ));
        $this->umur = htmlspecialchars(strip_tags($this->umur ));
        $this->intensitas_serangan = htmlspecialchars(strip_tags($this->intensitas_serangan ));
        $this->luas_terserang = htmlspecialchars(strip_tags($this->luas_tersrang ));
        $this->luas_hamparan = htmlspecialchars(strip_tags($this->luas_hamparan ));
        $this->gambar = htmlspecialchars(strip_tags($this->gambar ));
        $this->tanggal = htmlspecialchars(strip_tags($this->tanggal ));
        $this->jenis_musuh_alami = htmlspecialchars(strip_tags($this->jenis_musuh_alami ));
        $this->kesimpulan = htmlspecialchars(strip_tags($this->kesimpulan ));
        $this->rekomendasi = htmlspecialchars(strip_tags($this->rekomendasi ));
        $this->id_status_report = htmlspecialchars(strip_tags($this->id_status_report));
        $this->keterangan_tanaman = htmlspecialchars(strip_tags($this->keterangan_tanaman));

        if($this->dbh->prepare($sql)->execute([$this->id_user, $this->judul_laporan, $this->id_penyakit,
                                              $this->id_kec, $this->desa,$this->id_jenis_tanaman, $this->varietas, $this->umur,
                                              $this->intensitas_serangan, $this->luas_tersrang, $this->luas_hamparan,
                                              $this->gambar, $this->tanggal, $this->jenis_musuh_alami,
                                              $this->kesimpulan, $this->rekomendasi, $this->id_status_report, $this->keterangan_tanaman])){
          return true;
        };
        return false;
      }

      function update(){
        $sql = "UPDATE $this->table_name SET id_user = ?, judul_laporan = ?, id_penyakit = ?, id_kec = ?,
                                                desa = ?, id_jenis_tanaman = ?, varietas = ?, umur = ?,
                                                intensitas_serangan = ?, luas_terserang = ?, luas_hamparan = ?, gambar = ?,
                                                tanggal = ?, jenis_musuh_alami = ?, kesimpulan = ?, rekomendasi = ?, id_status_report = ?,
                                                keterangan_tanaman = ? WHERE id_laporan_opt = ?";

        $this->id_user = htmlspecialchars(strip_tags($this->id_user ));
        $this->judul_laporan = htmlspecialchars(strip_tags($this->judul_laporan ));
        $this->id_penyakit = htmlspecialchars(strip_tags($this->id_penyakit ));
        $this->id_kec = htmlspecialchars(strip_tags($this->id_kec ));
        $this->desa = htmlspecialchars(strip_tags($this->desa ));
        $this->id_jenis_tanaman = htmlspecialchars(strip_tags($this->id_jenis_tanaman));
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
        $this->id_status_report = htmlspecialchars(strip_tags($this->id_status_report));
        $this->keterangan_tanaman = htmlspecialchars(strip_tags($this->keterangan_tanaman));
        $this->id_laporan_opt = htmlspecialchars(strip_tags($this->id_laporan_opt ));

        if($this->dbh->prepare($sql)->execute([$this->id_user, $this->judul_laporan, $this->id_penyakit,
                                              $this->id_kec, $this->desa, $this->id_jenis_tanaman, $this->varietas, $this->umur,
                                              $this->intensitas_serangan, $this->luas_tersrang, $this->luas_hamparan,
                                              $this->gambar, $this->tanggal, $this->jenis_musuh_alami,
                                              $this->kesimpulan,$this->rekomendasi, $this->id_status_report, $this->keterangan_tanaman,
                                              $this->id_laporan_opt])){
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

      function exportExcelPegawai()
      {
        $month = date('n');
        $year = date('Y');
        $sql = "SELECT $this->table_name.*,
                      tanaman.nama as nama_tanaman,
                      status_report.nama_status_report,
                      opt.nama as nama_penyakit,
                      users.nama_lengkap
                FROM $this->table_name
                INNER JOIN users ON users.id_users = $this->table_name.id_user
                INNER JOIN opt ON opt.id = $this->table_name.id_penyakit
                INNER JOIN tanaman ON tanaman.id = $this->table_name.id_jenis_tanaman
                INNER JOIN status_report ON status_report.id_status_report = $this->table_name.id_status_report
                WHERE MONTH ($this->table_name.tanggal) = $month
                AND YEAR ($this->table_name.tanggal) = $year
                AND $this->table_name.id_user = ?";

        $this->id_user = htmlspecialchars(strip_tags($this->id_user));
        try{
          $stmt = $this->dbh->prepare($sql);
          $stmt->execute([$this->id_user]);
          // echo $this->id_user.$this->bulan;
          // echo $sql;
          return $stmt;
        }catch(PDOException $e){
          echo $e->getMessage();
        }
      }

      function exportExcelKoordinator()
      {
        $month = date('n');
        $year = date('Y');
        $sql = "SELECT $this->table_name.*,
                      tanaman.nama as nama_tanaman,
                      status_report.nama_status_report,
                      opt.nama as nama_penyakit,
                      users.nama_lengkap
                FROM $this->table_name
                INNER JOIN users ON users.id_users = $this->table_name.id_user
                INNER JOIN opt ON opt.id = $this->table_name.id_penyakit
                INNER JOIN tanaman ON tanaman.id = $this->table_name.id_jenis_tanaman
                INNER JOIN status_report ON status_report.id_status_report = $this->table_name.id_status_report
                WHERE MONTH ($this->table_name.tanggal) = $month
                AND YEAR ($this->table_name.tanggal) = $year
                AND users.id_koordinator = ?";

        $this->id_koordinator = htmlspecialchars(strip_tags($this->id_koordinator));
        try{
          $stmt = $this->dbh->prepare($sql);
          $stmt->execute([$this->id_koordinator]);
          // echo $this->id_user.$this->bulan;
          // echo $sql;
          return $stmt;
        }catch(PDOException $e){
          echo $e->getMessage();
        }
      }
      function exportExcelAdmin()
      {
        $month = date('n');
        $year = date('Y');
        $sql = "SELECT $this->table_name.*,
                      tanaman.nama as nama_tanaman,
                      status_report.nama_status_report,
                      opt.nama as nama_penyakit,
                      users.nama_lengkap
                FROM $this->table_name
                INNER JOIN users ON users.id_users = $this->table_name.id_user
                INNER JOIN opt ON opt.id = $this->table_name.id_penyakit
                INNER JOIN tanaman ON tanaman.id = $this->table_name.id_jenis_tanaman
                INNER JOIN status_report ON status_report.id_status_report = $this->table_name.id_status_report
                WHERE MONTH ($this->table_name.tanggal) = $month
                AND YEAR ($this->table_name.tanggal) = $year";

        try{
          $stmt = $this->dbh->prepare($sql);
          $stmt->execute();
          // echo $this->id_user.$this->bulan;
          // echo $sql;
          return $stmt;
        }catch(PDOException $e){
          echo $e->getMessage();
        }
      }
    }


?>
