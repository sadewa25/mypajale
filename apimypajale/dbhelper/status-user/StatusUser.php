<?php

  class StatusUser{
    public $id_status_user;
    public $nama_status_user;
    public $table_name = "status_user";

    function __construct($dbh){
      $this->dbh = $dbh;
    }

    function select($column = 1, $value = 1){
      switch($column) {
          case 'id_status_user':
              $col[] = 'id_status_user = ?';
              break;
          case 'nama_status_user':
              $col[] = 'nama_status_user = ?';
              break;
          case 1:
              $col[] = '1 = ?';
              break;
      }
      $sql = "SELECT * FROM $this->table_name";
      // $end = "ORDER BY LPAD(LOWER(nama_status_user), 10,0) ASC";
      $sql .= " WHERE ".implode(" AND ", $col);
      $stmt = $this->dbh->prepare($sql);
      $stmt->execute([$value]);
      // print_r($stmt);
      return $stmt;
    }

    function insert(){

      $sql = "INSERT INTO $this->table_name (nama_status_user) VALUES (?)";

      $this->nama_status_user = htmlspecialchars(strip_tags($this->nama_status_user));

      if($this->dbh->prepare($sql)->execute([$this->nama_status_user])){
        return true;
      };
      return false;
    }

    function update(){
      $sql = "UPDATE $this->table_name SET nama_status_user = ? WHERE id_status_user = ?";

      $this->nama_status_user = htmlspecialchars(strip_tags($this->nama_status_user));
      $this->id_status_user = htmlspecialchars(strip_tags($this->id_status_user));

      if($this->dbh->prepare($sql)->execute([$this->nama_status_user, $this->id_status_user])){
        return true;
      }
      return false;
    }

    function delete(){
      $sql = "DELETE FROM $this->table_name WHERE id_status_user = ?";

      $this->id_status_user = htmlspecialchars(strip_tags($this->id_status_user));

      if($this->dbh->prepare($sql)->execute([$this->id_status_user])){
        return true;
      }
      return false;
    }
  }

?>
