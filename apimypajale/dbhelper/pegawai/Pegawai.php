<?php

class Pegawai{
  public $nip_pegawai;
  public $password_pegawai;
  public $nama_pegawai;
  public $nip_koordinator;
  public $table_name = "pegawai";

  function __construct($dbh){
    $this->dbh = $dbh;
  }

  function select($column = 1, $value = 1){
    switch($column) {
        case 'nip_pegawai':
            $col[] = 'nip_pegawai = ?';
            break;
        case 'nip_koordinator':
            $col[] = 'nip_koordinator = ?';
            break;
        case 1:
            $col[] = '1 = ?';
            break;
    }
    $sql = "SELECT * FROM $this->table_name";
    // $end = "ORDER BY LPAD(LOWER(id), 10,0) ASC";
    $sql .= " WHERE ".implode(" AND ", $col);
    $stmt = $this->dbh->prepare($sql);
    $stmt->execute([$value]);
    // print_r($stmt);
    return $stmt;
  }

  // function insert(){
  //   $sql = "INSERT INTO $this->table_name (nama_lengkap, email_user, password_user, telephone_user, profesi, kabupaten, kecamatan, alamat, id_status_users) VALUES (?,?,?,?,?,?,?,?,?)";
  //
  //   $this->nama_lengkap = htmlspecialchars(strip_tags($this->nama_lengkap));
  //   $this->email_user = htmlspecialchars(strip_tags($this->email_user));
  //   $this->password_user = htmlspecialchars(strip_tags($this->password_user));
  //   $this->telephone_user = htmlspecialchars(strip_tags($this->telephone_user));
  //   $this->profesi = htmlspecialchars(strip_tags($this->profesi));
  //   $this->kabupaten = htmlspecialchars(strip_tags($this->kabupaten));
  //   $this->kecamatan = htmlspecialchars(strip_tags($this->kecamatan));
  //   $this->alamat = htmlspecialchars(strip_tags($this->alamat));
  //   $this->id_status_users = htmlspecialchars(strip_tags($this->id_status_users));
  //
  //   if($this->dbh->prepare($sql)->execute([$this->nama_lengkap, $this->email_user, $this->password_user,
  //                                           $this->telephone_user, $this->profesi, $this->kabupaten,
  //                                           $this->kecamatan, $this->alamat, $this->id_status_users])){
  //     return true;
  //   };
  //   return false;
  // }

  // function update(){
  //   $sql = "UPDATE $this->table_name SET nama_lengkap = ?, email_user = ?, password_user = ?, telephone_user = ?, profesi = ?, kabupaten = ?, kecamatan = ?, alamat = ?, id_status_users = ? WHERE id_users = ?";
  //
  //   $this->id_users = htmlspecialchars(strip_tags($this->id_users));
  //   $this->nama_lengkap = htmlspecialchars(strip_tags($this->nama_lengkap));
  //   $this->email_user = htmlspecialchars(strip_tags($this->email_user));
  //   $this->password_user = htmlspecialchars(strip_tags($this->password_user));
  //   $this->telephone_user = htmlspecialchars(strip_tags($this->telephone_user));
  //   $this->profesi = htmlspecialchars(strip_tags($this->profesi));
  //   $this->kabupaten = htmlspecialchars(strip_tags($this->kabupaten));
  //   $this->kecamatan = htmlspecialchars(strip_tags($this->kecamatan));
  //   $this->alamat = htmlspecialchars(strip_tags($this->alamat));
  //   $this->id_status_users = htmlspecialchars(strip_tags($this->id_status_users));
  //
  //   if($this->dbh->prepare($sql)->execute([$this->nama_lengkap, $this->email_user, $this->password_user,
  //                                           $this->telephone_user, $this->profesi, $this->kabupaten,
  //                                           $this->kecamatan, $this->alamat, $this->id_status_users,
  //                                           $this->id_users])){
  //     return true;
  //   }
  //   return false;
  // }

  // function delete(){
  //   $sql = "DELETE FROM $this->table_name WHERE id_users = ?";
  //
  //   $this->id_users = htmlspecialchars(strip_tags($this->id_users));
  //
  //   if($this->dbh->prepare($sql)->execute([$this->id_users])){
  //     return true;
  //   }
  //   return false;
  // }

  function login(){
    //change this if there a password field
    $sql = "SELECT * FROM $this->table_name WHERE nip_pegawai = ? AND password_pegawai = ?";

    $this->nip_pegawai = htmlspecialchars(strip_tags($this->nip_pegawai));
    $this->password_pegawai = htmlspecialchars(strip_tags($this->password_pegawai));

    $stmt = $this->dbh->prepare($sql);
    $stmt->execute([ $this->nip_pegawai, $this->password_pegawai]); //and this to
    return $stmt;
  }

  // function changePassword(){
  //   $sql = "UPDATE $this->table_name SET password_user = ? WHERE email_user = ?";
  //
  //   $this->email_user = htmlspecialchars(strip_tags($this->email_user));
  //   $this->password_user = htmlspecialchars(strip_tags($this->password_user));
  //
  //   $stmt = $this->dbh->prepare($sql)->execute([$this->password_user, $this->email_user]);
  //   if($stmt){
  //     return true;
  //   }
  //   return false;
  // }
}

?>
