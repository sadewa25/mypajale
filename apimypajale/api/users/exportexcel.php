<?php
  // set the header file
  $id_user = $_GET['id_user'];
  $bulan = date('n');
  $year = date('Y');

  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Headers: access");
  header("Access-Control-Allow-Methods: GET");
  header("Access-Control-Allow-Credentials: true");
  header("Content-type: application/vnd-ms-excel");
  header("Content-Disposition: attachment; filename=Data-Laporan-Tetap-Bulan-$bulan-Tahun-$year.xls");

  //call importan file
  require_once '../../dbhelper/connection.php';
  require_once '../../dbhelper/laporan-opt-tetap/LaporanTetap.php';
  //
  $laporan = new LaporanTetap($dbh);
  $no = 1;
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Export Excel</title>
    <style media="screen">
      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
      }

      table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
        margin: 10px 25px;
        text-align: justify;
        padding: 5px;
      }

      th {
        text-align: center;
        background: gray;
      }

    </style>
  </head>
  <body>
    <table>
      <thead>
        <th>No</th>
        <th>Judul Laporan</th>
        <th>Nama OPT</th>
        <th>Kecamatan</th>
        <th>Desa</th>
        <th>Jenis Tanaman</th>
        <th>Varietas</th>
        <th>Umur</th>
        <th>Intersitas Serangan</th>
        <th>Luas Terserang</th>
        <th>Luas Haparan</th>
        <th>Nama File Gambar</th>
        <th>Tanggal Laporan</th>
        <th>Jenis Musuh Alami</th>
        <th>Kesimpulan</th>
        <th>Rekomendasi</th>
        <th>Keterangan Tanaman</th>
        <th>Nama Pelapor</th>
        <th>Status Laporan</th>
      </thead>
      <tbody>
        <?php
          if (!empty($id_user)) {
            $laporan->id_user = $id_user;

            $stmt = $laporan->exportExcelPegawai();
            // print_r($stmt->fetchAll());
            $num = $stmt->rowCount();
            if ($num > 0) {
              // print_r($stmt->fetch(PDO::FETCH_ASSOC));
              while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                echo "<tr>
                        <td>$no</td>
                        <td>$judul_laporan</td>
                        <td>$nama_penyakit</td>
                        <td>$id_kec</td>
                        <td>$desa</td>
                        <td>$nama_tanaman</td>
                        <td>$varietas</td>
                        <td>$umur</td>
                        <td>$intensitas_serangan</td>
                        <td>$luas_terserang</td>
                        <td>$luas_hamparan</td>
                        <td>$gambar</td>
                        <td>$tanggal</td>
                        <td>$jenis_musuh_alami</td>
                        <td>$kesimpulan</td>
                        <td>$rekomendasi</td>
                        <td>$keterangan_tanaman</td>
                        <td>$nama_lengkap</td>
                        <td>$nama_status_report</td>
                      </tr>";
                $no++;
              }
            }
            else{
              echo "<td colspan='3'>Tidak ada data.</td>";
            }
          }else {
            echo "Tidak bisa mengunggah laporan.";
          }
          ?>
      </tbody>
    </table>
  </body>
</html>
