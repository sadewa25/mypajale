<?php

class Users{
  public $id_users;
  public $nama_lengkap;
  public $email_user;
  public $username_user;
  public $password_user;
  public $telephone_user;
  public $profesi;
  public $kabupaten;
  public $kecamatan;
  public $alamat;
  public $id_status_users;
  public $id_koordinator;
  public $table_name = "users";

  function __construct($dbh){
    $this->dbh = $dbh;
  }

  function select($column = 1, $value = 1){
    switch($column) {
        case 'id_users':
            $col[] = 'id_users = ?';
            break;
        case 'email_user':
            $col[] = 'email_user = ?';
            break;
        case 'id_status_users':
            $col[] = 'id_status_users = ?';
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

  function insert(){
    $sql = "INSERT INTO $this->table_name (id_users, nama_lengkap, email_user, password_user,
                                            telephone_user, profesi, kabupaten, kecamatan,
                                            alamat, id_status_users, id_koordinator) VALUES (?,?,?,?,?,?,?,?,?,?,null)";

    $this->username_user = htmlspecialchars(strip_tags($this->username_user));
    $this->nama_lengkap = htmlspecialchars(strip_tags($this->nama_lengkap));
    $this->email_user = htmlspecialchars(strip_tags($this->email_user));
    $this->password_user = htmlspecialchars(strip_tags($this->password_user));
    $this->telephone_user = htmlspecialchars(strip_tags($this->telephone_user));
    $this->profesi = htmlspecialchars(strip_tags($this->profesi));
    $this->kabupaten = htmlspecialchars(strip_tags($this->kabupaten));
    $this->kecamatan = htmlspecialchars(strip_tags($this->kecamatan));
    $this->alamat = htmlspecialchars(strip_tags($this->alamat));
    $this->id_status_users = htmlspecialchars(strip_tags($this->id_status_users));
    $this->id_koordinator = htmlspecialchars(strip_tags($this->id_koordinator));


    if($this->dbh->prepare($sql)->execute([$this->username_user, $this->nama_lengkap, $this->email_user, $this->password_user,
                                            $this->telephone_user, $this->profesi, $this->kabupaten,
                                            $this->kecamatan, $this->alamat, $this->id_status_users])){
      return true;
    };
    return false;
  }

  function update(){
    $sql = "UPDATE $this->table_name SET nama_lengkap = ?, email_user = ?, password_user = ?, telephone_user = ?, profesi = ?, kabupaten = ?, kecamatan = ?, alamat = ?, id_status_users = ? WHERE id_users = ?";

    $this->id_users = htmlspecialchars(strip_tags($this->id_users));
    $this->nama_lengkap = htmlspecialchars(strip_tags($this->nama_lengkap));
    $this->email_user = htmlspecialchars(strip_tags($this->email_user));
    $this->password_user = htmlspecialchars(strip_tags($this->password_user));
    $this->telephone_user = htmlspecialchars(strip_tags($this->telephone_user));
    $this->profesi = htmlspecialchars(strip_tags($this->profesi));
    $this->kabupaten = htmlspecialchars(strip_tags($this->kabupaten));
    $this->kecamatan = htmlspecialchars(strip_tags($this->kecamatan));
    $this->alamat = htmlspecialchars(strip_tags($this->alamat));
    $this->id_status_users = htmlspecialchars(strip_tags($this->id_status_users));

    if($this->dbh->prepare($sql)->execute([$this->nama_lengkap, $this->email_user, $this->password_user,
                                            $this->telephone_user, $this->profesi, $this->kabupaten,
                                            $this->kecamatan, $this->alamat, $this->id_status_users,
                                            $this->id_users])){
      return true;
    }
    return false;
  }

  function delete(){
    $sql = "DELETE FROM $this->table_name WHERE id_users = ?";

    $this->id_users = htmlspecialchars(strip_tags($this->id_users));

    if($this->dbh->prepare($sql)->execute([$this->id_users])){
      return true;
    }
    return false;
  }

  function login(){
    $sql = "SELECT * FROM $this->table_name WHERE email_user = ? AND password_user = ?";
    if (!strpos($this->username_user, '@')) {
      $sql = "SELECT * FROM $this->table_name WHERE id_users = ? AND password_user = ?";
    }
    $this->username_user = htmlspecialchars(strip_tags($this->username_user));
    $this->password_user = htmlspecialchars(strip_tags($this->password_user));
    // echo $sql;
    $stmt = $this->dbh->prepare($sql);
    $stmt->execute([$this->username_user, $this->password_user]);
    return $stmt;
  }

  function changePassword(){
    $sql = "UPDATE $this->table_name SET password_user = ? WHERE email_user = ?";

    $this->email_user = htmlspecialchars(strip_tags($this->email_user));
    $this->password_user = htmlspecialchars(strip_tags($this->password_user));

    $stmt = $this->dbh->prepare($sql)->execute([$this->password_user, $this->email_user]);
    if($stmt){
      return true;
    }
    return false;
  }

  function checkUsername(){
    $sql = "SELECT * FROM $this->table_name WHERE id_users = ?";
    $this->username_user = htmlspecialchars(strip_tags($this->username_user));
    $stmt = $this->dbh->prepare($sql);
    $stmt->execute([$this->username_user]);
    return $stmt->rowCount();
  }
}

?>
