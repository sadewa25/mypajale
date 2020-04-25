<?php
  //set the header file
  header("Content-type: application/vnd-ms-excel");
  header("Content-Disposition: attachment; filename=Data Tanaman.xls");

  //call importan file
  require_once '../../dbhelper/connection.php';
  require_once '../../dbhelper/tanaman/Tanaman.php';

  $tanaman = new Tanaman($dbh);
  $stmt = $tanaman->select();
  $num = $stmt->rowCount();
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
        <th>Nama Tanaman</th>
        <th>Deskripsi Tanaman</th>
      </thead>
      <tbody>
        <?php
          if ($num > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
              extract($row);
              echo "<tr>
                      <td>$no</td>
                      <td>$nama</td>
                      <td>$deskripsi</td>
                    </tr>";
              $no++;
            }
          }else{
            echo "<td colspan='3'>Tidak ada data.</td>";
          }
          ?>
      </tbody>
    </table>
  </body>
</html>
